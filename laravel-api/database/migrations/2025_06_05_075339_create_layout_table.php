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
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();
            $table->string('author', 100);
            $table->string('layout_name', 100);
            $table->string('type', 100);
            $table->string('title', 255);
            $table->text('link') -> nullable();
            $table->text('html') -> nullable();
            $table->text('css') -> nullable();
            $table->text('js') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layouts');
    }
};
