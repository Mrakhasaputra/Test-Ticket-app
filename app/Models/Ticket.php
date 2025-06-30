<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'title',
        'description',
        'ticket_type_id',
        'assign_at',
        'status',
        'project_id',
    ];

    public function ticket_type()
    {
        return $this->belongsTo(ticket_type::class);
    }

    public function project()
    {
        return $this->belongsTo(project::class);
    }
}
