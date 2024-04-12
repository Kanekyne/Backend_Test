<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('quantity');
            $table->float('price')->nullable();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('set null');

            $table->timestamps();
        });

        $now = now();

        DB::table('products')->insert([
            ['name' => 'Zanahoria', 'description' => 'Esta naranjada', 'quantity' => 100, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Arroz', 'description' => 'Blanco', 'quantity' => 98, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cebolla', 'description' => 'De la planta', 'quantity' => 57, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ñame', 'description' => 'De espina', 'quantity' => 0, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mamon', 'description' => 'No esta maduro, no estamos en tiempo de cosecha', 'quantity' => 120, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Manzana', 'description' => 'Verde, madura.', 'quantity' => 10, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Yuca', 'description' => 'No esta lavada', 'quantity' => 86, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lechuga', 'description' => 'Esta madura', 'quantity' => 95, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Frijol', 'description' => 'Negros, para el arroz de semana santa', 'quantity' => 95, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Apio', 'description' => 'Son mazos grandes', 'quantity' => 95, 'price' => mt_rand(0, 76089) / 100, 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);


    }



    //     id (primary key)
// name
// description
// quantity
// category_id (foreign key references categories.id)

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
