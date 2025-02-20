<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyPricelogger extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->double('price', 10, 0)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->dropColumn('price');
        });
    }
}
