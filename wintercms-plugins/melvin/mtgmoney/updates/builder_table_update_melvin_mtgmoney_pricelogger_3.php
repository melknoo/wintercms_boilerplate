<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyPricelogger3 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->renameColumn('card_relation_id', 'cards_id');
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->renameColumn('cards_id', 'card_relation_id');
        });
    }
}
