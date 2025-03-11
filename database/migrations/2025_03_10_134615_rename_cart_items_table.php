<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Rename cart__items to cart_items
public function up()
{
    Schema::rename('cart__items', 'cart_items');
}

public function down()
{
    Schema::rename('cart_items', 'cart__items');
}

};
