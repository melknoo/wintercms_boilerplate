<?php namespace Melvin\Mtgmoney;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function register() {
        $this->registerConsoleCommand('mtg:price', 'Melvin\Mtgmoney\Console\PriceLog');
        $this->registerConsoleCommand('mtg:test', 'Melvin\Mtgmoney\Console\TestCron');
        $this->registerConsoleCommand('mtg:data', 'Melvin\Mtgmoney\Console\MTGJsonHelper');
        $this->registerConsoleCommand('mtg:auto', 'Melvin\Mtgmoney\Console\MTGAutocomplete');
        $this->registerConsoleCommand('mtg:up', 'Melvin\Mtgmoney\Console\MTGUp');
        $this->registerConsoleCommand('mtg:sets', 'Melvin\Mtgmoney\Console\MTGSet');
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('mtg:price')->everyThirtyMinutes();
        //$schedule->command('mtg:crontest')->everyMinute();
    }
}
