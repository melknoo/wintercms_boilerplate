<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMelvinMtgmoneyCards extends Migration
{
    public function up()
    {
        Schema::create('melvin_mtgmoney_cards', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->text('name')->nullable();
            $table->double('price', 10, 0)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('melvin_mtgmoney_cards');
    }
}
