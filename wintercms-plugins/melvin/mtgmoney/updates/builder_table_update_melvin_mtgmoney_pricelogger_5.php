<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyPricelogger5 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->dropColumn('cards_id_id');
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->integer('cards_id_id')->nullable();
        });
    }
}
