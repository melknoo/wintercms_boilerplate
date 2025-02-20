<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyCards3 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->renameColumn('pricelogger_id', 'price_logger_id');
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->renameColumn('price_logger_id', 'pricelogger_id');
        });
    }
}
