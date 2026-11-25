<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('category');
            $table->string('location');
            $table->text('description');
            $table->string('photo');
            $table->string('status')->default('menunggu');
            $table->text('admin_note')->nullable();
            $table->text('technician_note')->nullable();
            $table->string('evidence_photo')->nullable();
            $table->date('reported_on');
            $table->timestamps();
            $table->index(['status','reported_on']);
        });
    }
    public function down(): void { Schema::dropIfExists('reports'); }
};
