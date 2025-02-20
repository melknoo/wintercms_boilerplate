<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMelvinMtgmoneyPricelogger extends Migration
{
    public function up()
    {
        Schema::create('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('card_relation_id');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('melvin_mtgmoney_pricelogger');
    }
}
