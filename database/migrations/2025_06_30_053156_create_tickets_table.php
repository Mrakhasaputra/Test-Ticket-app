
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('ticket_type_id')->constrained('ticket_types');
            $table->date('assign_at');
            $table->enum('status', ['open', 'progress', 'closed', 'cancel'])->default('open');
            $table->foreignId('project_id')->constrained('projects');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};