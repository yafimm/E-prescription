<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signa_m', function (Blueprint $table) {
          $table->id('signa_id');
          $table->string('signa_kode', 100)->nullable();
          $table->string('signa_nama', 250)->nullable();
          $table->text('additional_data')->nullable();
          $table->datetime('created_date')->nullable();
          $table->integer('created_by')->unisgned()->nullable();
          $table->integer('modified_count')->unsigned()->nullable();
          $table->datetime('last_modified_date')->nullable();
          $table->integer('last_modified_by')->unsigned()->nullable();
          $table->tinyInteger('is_deleted')->default(0);
          $table->tinyInteger('is_active')->default(1);
          $table->datetime('deleted_date')->nullable();
          $table->integer('deleted_by')->nullable();
          // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signa_m');
    }
}
