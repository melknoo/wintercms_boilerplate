<?php namespace Melvin\Mtgmoney\Models;

use Model;
use Mail;
use Winter\User\Models\User;

/**
 * Model
 */
class PriceLogger extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    use \Winter\Storm\Database\Traits\SoftDelete;

    /**
     * @var string
     */
    private static $mail_adress = "mtgpricetrends@web.de";
    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'melvin_mtgmoney_pricelogger';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];

    public static function GetPricesByCardId($cards_id) {
        return PriceLogger::where('cards_id', $cards_id)->get();
    }

    public static function GetLowestPriceByCardId($cards_id, $user_id = NULL) {
        if(isset($user_id)) {
            return PriceLogger::where([
                ['user_id', $user_id],
                ['cards_id', $cards_id]
            ])->orderBy('price', 'asc')->first();
        }
        return PriceLogger::where('cards_id', $cards_id)->orderBy('price', 'asc')->first();
    }

    public static function GetHighestPriceByCardId($cards_id, $user_id = NULL) {
        if(isset($user_id)) {
            return PriceLogger::where([
                ['user_id', $user_id],
                ['cards_id', $cards_id]
            ])->orderBy('price', 'desc')->first();
        }
        return PriceLogger::where('cards_id', $cards_id)->orderBy('price', 'desc')->first();
    }

    public static function SimpleizeDataByCardID($card_id) {
        $entries = PriceLogger::where('cards_id', $card_id)->orderBy('created_at', 'desc')->get();
        $mergedEntries = [];

        $prevEntry = null;
        foreach ($entries as $entry) {
            if ($prevEntry && $entry->price === $prevEntry->price) {
                // Lösche den aktuellen Eintrag, wenn der Preis gleich ist
                $entry->delete();
            } else {
                $prevEntry = $entry;
            }
        }

        return true;
    }

    public static function PriceUpdate($user_id = NULL) {
        if(isset($user_id)) {
            $cards = Cards::where('user_id', $user_id)->get();
        }
        else {
            $cards = Cards::all();
        }
        foreach($cards as $item) {
            $mail = null;
            $name = $item->name;
            $user_id_for_mail = $item->user_id;
            $price = Cards::SearchCard($name, $item->is_display, $item->is_booster);

            $double_price = Cards::TransformPrice($price);
            $result = PriceLogger::CheckPriceOfCard($double_price, $item->id);
            $pricelog = PriceLogger::where('cards_id', $item->id)->latest()->first();
            $oldPrice = Cards::MakePriceGreatAgain($pricelog->price);
            if($result && $item->notification) {
                $user = User::where('id', $user_id_for_mail)->first();
                $mail = $user->email;
                PriceLogger::sendMailNotification("Der neue Preis für ".$item->name." ist " .$price.". Vorheriger Preis war: ".$oldPrice, "Neuer Tiefpreis für ".$item->name, $mail);
            }

            PriceLogger::createNewPriceLog($double_price, $item->id, $user_id_for_mail);
            $item->price = $double_price;
            $item->save();
        }
    }

    public static function sendMailNotification($text, $subject, $mail = NULL) {
        $data = array(
            "text" => $text,
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
        $params = array(
            "subject" => $subject,
            "text" => $text
        );
        if(!isset($mail)) {
            $mail = self::$mail_adress;
        }

        Mail::sendTo($mail, 'melvin.mtgmoney::mail.notification', $params);
    }

    public static function CheckPriceOfCard($price_new, $card_id) {
        $pricelog = PriceLogger::where('cards_id', $card_id)->latest()->first();
        $lastPrice = (double)$pricelog->price;
        $price_new = (double)$price_new;
        if($price_new < $lastPrice) {
            return $pricelog;
        }
        return false;
    }

    public static function CreateNewPriceLog($price, $card_id, $user_id = NULL) {
        $price_log = new PriceLogger();
        $price_log->price = $price;
        $price_log->user_id = $user_id;
        $price_log->cards_id = $card_id;
        $price_log->save();
    }

    public static function TransformForChart($prices) {
        $return = array();
        foreach($prices as $item ) {
            $price = $item->price;
            $date = date('d.m.y-H:i',strtotime($item->created_at));
            $tempArr = [
                0 => $date,
                1 => $price
            ];
            array_push($return, $tempArr);
        }
        return $return;
    }

}
