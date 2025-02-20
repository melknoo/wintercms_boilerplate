<?php namespace Melvin\Mtgmoney\Console;
use Melvin\Mtgmoney\Models\Autocomplete;
//use Winter\Storm\Console\Command;
use Illuminate\Console\Command;

use Melvin\Mtgmoney\Models\MTGJson;

class MTGUp extends Command
{
    protected static $defaultName = 'mtg:up';
    protected $signature = 'mtg:up';
    /**
     * @var string The console command description.
     */
    protected $description = 'Logs current price for Cards';

    public function handle()
    {
        echo "getting data... \n";
        MTGJson::getMTGJson();
        echo "creating autocompletes...";
        Autocomplete::createAutocompletes();
    }
}