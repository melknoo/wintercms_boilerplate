<?php namespace Melvin\Mtgmoney\Console;
//use Winter\Storm\Console\Command;
use Illuminate\Console\Command;

use Melvin\Mtgmoney\Models\MTGJson;

class MTGSet extends Command
{
    protected static $defaultName = 'mtg:sets';
    protected $signature = 'mtg:sets';
    /**
     * @var string The console command description.
     */
    protected $description = 'Logs current price for Cards';

    public function handle()
    {
        echo "yo works";   
    }
}