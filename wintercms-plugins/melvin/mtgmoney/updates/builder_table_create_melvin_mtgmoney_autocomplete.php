<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMelvinMtgmoneyAutocomplete extends Migration
{
    public function up()
    {
        Schema::create('melvin_mtgmoney_autocomplete', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('melvin_mtgmoney_autocomplete');
    }
}
