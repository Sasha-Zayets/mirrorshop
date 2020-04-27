<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru')->nullable();
            $table->string('title_ua')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('description_ua')->nullable();
            $table->smallInteger('sort')->default(0)->comment('Сортування');
            $table->tinyInteger('active')->index()->default(1)
                ->comment('Активність');
            $table->tinyInteger('type')->default(1)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
