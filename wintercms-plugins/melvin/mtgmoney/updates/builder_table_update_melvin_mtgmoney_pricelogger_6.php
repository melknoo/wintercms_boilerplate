<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyPricelogger6 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->integer('user_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_pricelogger', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
