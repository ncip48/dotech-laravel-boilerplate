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
        Schema::create('group_menus', function (Blueprint $table) {
            $table->id('group_menu_id');
            $table->unsignedBigInteger('group_id')->index()->nullable();
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
            $table->unsignedBigInteger('menu_id')->index()->nullable();
            $table->foreign('menu_id')->references('menu_id')->on('menus')->onDelete('cascade');
            $table->integer('create')->default(0);
            $table->integer('read')->default(0);
            $table->integer('update')->default(0);
            $table->integer('delete')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_menus');
    }
};
