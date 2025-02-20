<?php namespace Melvin\Mtgmoney\Console;
use Melvin\Mtgmoney\Models\Autocomplete;
//use Winter\Storm\Console\Command;
use Illuminate\Console\Command;

use Melvin\Mtgmoney\Models\MTGJson;

class MTGAutocomplete extends Command
{
    protected static $defaultName = 'mtg:auto';
    protected $signature = 'mtg:auto';
    /**
     * @var string The console command description.
     */
    protected $description = 'Logs current price for Cards';

    public function handle()
    {
        Autocomplete::createAutocompletes();
    }
}