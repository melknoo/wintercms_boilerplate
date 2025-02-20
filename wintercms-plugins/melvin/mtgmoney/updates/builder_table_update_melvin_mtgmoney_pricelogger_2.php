<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyPricelogger2 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->integer('card_relation_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->integer('card_relation_id')->nullable(false)->change();
        });
    }
}
