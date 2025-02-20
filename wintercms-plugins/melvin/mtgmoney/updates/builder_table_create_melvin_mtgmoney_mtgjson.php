<?php namespace Melvin\Mtgmoney\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMelvinMtgmoneyMtgjson extends Migration
{
    public function up()
    {
        Schema::create('melvin_mtgmoney_mtgjson', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('name')->nullable();
            $table->text('type')->nullable();
            $table->text('set')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('melvin_mtgmoney_mtgjson');
    }
}
