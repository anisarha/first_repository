<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->string('nama_produk', 255); // Nama produk
            $table->string('kategori', 100); // Kategori produk
            $table->decimal('harga_jual', 15, 2); // Harga jual (rupiah, max 15 digits, 2 decimals)
            $table->decimal('harga_beli', 15, 2); // Harga beli (rupiah, max 15 digits, 2 decimals)
            $table->integer('stok'); // Stok (integer)
            $table->enum('status', ['ACTIVE', 'NOT ACTIVE'])->default('ACTIVE'); // Status dengan default 'ACTIVE'
            $table->string('created_by', 255); // Pembuat (varchar)
            $table->dateTime('created_date'); // Tanggal dibuat
            $table->string('updated_by', 255)->nullable(); // Pengupdate (varchar)
            $table->dateTime('update_date')->nullable(); // Tanggal update
            $table->dateTime('void_date')->nullable(); // Tanggal void
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
