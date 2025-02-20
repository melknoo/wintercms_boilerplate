<?php namespace Melvin\Mtgmoney\Console;
//use Winter\Storm\Console\Command;
use Illuminate\Console\Command;

use Log;
use Melvin\Mtgmoney\Models\Cards;
use Melvin\Mtgmoney\Models\PriceLogger;
use simple_html_dom;

class TestCron extends Command
{
    protected static $defaultName = 'mtg:test';
    protected $signature = 'mtg:test';
    /**
     * @var string The console command description.
     */
    protected $description = 'Logs current price for Cards';

    public function handle()
    {
        $data = array(
            "text" => "Die ist eine test mail",
            "adress" => "melle17@gmx.de"
        );
        $url = "http://node-api:3000/mtgtestmail";  // Use the container name as the hostname

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result, true);
        print_r($result);

        return "joo";

    }

}