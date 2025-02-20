<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyCards11 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->boolean('is_display')->nullable(false)->change();
            $table->boolean('is_booster')->nullable(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->boolean('is_display')->nullable()->change();
            $table->boolean('is_booster')->nullable()->change();
        });
    }
}
