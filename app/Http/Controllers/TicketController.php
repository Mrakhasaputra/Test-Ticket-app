<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Models\ticket_type;
use App\Models\project;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ticket::query();
    
        // Cari berdasarkan judul
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }
    
        // Cari berdasarkan nama lengkap
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        $tickets = $query->with(['ticket_type', 'project'])->latest()->paginate(10);
    
        return view('tickets.index', compact('tickets'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = ticket_type::all();
        $projects = project::all();
        return view('tickets.create', compact('types', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'description' => 'required',
            'ticket_type_id' => 'required',
            'assign_at' => 'required',
            'project_id' => 'required',
        ]);

        $tickets = ticket::create([
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'description' => $request->description,
            'ticket_type_id' => $request->ticket_type_id,
            'assign_at' => $request->assign_at,
            'project_id' => $request->project_id,
        ]);
        
        if($tickets) {
            return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
        }else{
            return redirect()->route('tickets.index')->with('error', 'Ticket created failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::with(['ticket_type', 'project'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $types = Ticket_type::all();
        return view('tickets.edit', compact('ticket', 'types'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'description' => 'nullable|string',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'status' => 'required|in:open,progress,closed,cancel',
        ]);
    
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->only(['email', 'description', 'ticket_type_id', 'status']));
    
        return redirect()->route('tickets.index')->with('success', 'Tiket updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if($ticket->status !== 'cancel') {
            return redirect()->route('tickets.index')->with('error', 'Ticket cannot be deleted');
        }

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
    }
}
