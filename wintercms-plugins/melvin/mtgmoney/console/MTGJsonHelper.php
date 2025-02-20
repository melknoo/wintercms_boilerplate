<?php namespace Melvin\Mtgmoney\Console;
//use Winter\Storm\Console\Command;
use Illuminate\Console\Command;

use Melvin\Mtgmoney\Models\MTGJson;

class MTGJsonHelper extends Command
{
    protected static $defaultName = 'mtg:data';
    protected $signature = 'mtg:data';
    /**
     * @var string The console command description.
     */
    protected $description = 'Logs current price for Cards';

    public function handle()
    {
        MTGJson::getMTGJson();
    }
}