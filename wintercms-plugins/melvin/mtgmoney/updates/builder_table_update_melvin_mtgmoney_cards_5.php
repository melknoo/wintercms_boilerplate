<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyCards5 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->integer('price_logger_id_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->dropColumn('price_logger_id_id');
        });
    }
}
