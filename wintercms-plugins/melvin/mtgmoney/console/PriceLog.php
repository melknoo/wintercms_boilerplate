<?php namespace Melvin\Mtgmoney\Console;
//use Winter\Storm\Console\Command;
use Melvin\Mtgmoney\Models\Cards;
use Melvin\Mtgmoney\Models\PriceLogger;
use Illuminate\Console\Command;

class PriceLog extends Command
{

    protected static $defaultName = 'mtg:price';
    protected $signature = 'mtg:price';
    /**
     * @var string The console command description.
     */
    protected $description = 'Logs current price for Cards';

    public function handle()
    {
        PriceLogger::PriceUpdate();

        return "joo";

    }
}