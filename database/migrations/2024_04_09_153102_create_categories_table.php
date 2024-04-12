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
            ['name' => 'Fruta', 'description' => 'Estan recien cosechadas'],
            ['name' => 'Tuberculo', 'description' => 'Extraidos de la sabana bogotana'],
            ['name' => 'Hortaliza', 'description' => 'La mayoria son esfericas'],
            ['name' => 'Verdura', 'description' => 'Ni idea de para que sirvan'],
            ['name' => 'Grano', 'description' => 'El arroz es rraro'],
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
