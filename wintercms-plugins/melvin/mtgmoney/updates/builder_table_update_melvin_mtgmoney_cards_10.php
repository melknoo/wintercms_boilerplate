<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyCards10 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->boolean('is_display')->nullable()->default(0);
            $table->boolean('is_booster')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->dropColumn('is_display');
            $table->dropColumn('is_booster');
        });
    }
}
