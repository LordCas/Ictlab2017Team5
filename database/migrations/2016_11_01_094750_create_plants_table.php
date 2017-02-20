<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('x', 2, 1)->nullable();
            $table->decimal('y', 2, 1)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('action_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('plant_action_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plant_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->boolean('finish')->default(true);
            $table->timestamps();

            $table->foreign('plant_id')
                ->references('id')
                ->on('plants')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('action_types')
                ->onDelete('cascade');
        });

        

        DB::table('action_types')->insert([
            [
                'name' => 'Watering'
            ],
            [
                'name' => 'Relocate'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_action_logs');
        Schema::dropIfExists('action_types');
        Schema::dropIfExists('plants');
    }
}
