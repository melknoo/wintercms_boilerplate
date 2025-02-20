<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMelvinMtgmoneyCards8 extends Migration
{
    public function up()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->text('image')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('melvin_mtgmoney_cards', function($table)
        {
            $table->dropColumn('image');
        });
    }
}
