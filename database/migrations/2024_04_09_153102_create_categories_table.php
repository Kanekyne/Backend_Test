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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Fruta', 'description' => 'Estan recien cosechadas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tuberculo', 'description' => 'Extraidos de la sabana bogotana', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hortaliza', 'description' => 'La mayoria son esfericas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Verdura', 'description' => 'Ni idea de para que sirvan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grano', 'description' => 'El arroz es rraro', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
