<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventClassTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create( 'event_classes', function( $table ) {

      $table->engine = 'InnoDB';

      $table->increments('id');

      $table->integer('class_id')->unsigned();
      $table->integer('event_id')->unsigned();

      $table->integer('limit');
      $table->boolean('locked');

      $table->foreign('class_id')->references('id')->on('classes');
      $table->foreign('event_id')->references('id')->on('events');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('event_classes');
  }

}
