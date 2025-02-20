<?php namespace Melvin\Mtgmoney\Models;

use Model;
use Log;
use simple_html_dom;
use ValidationException;
use Flash;

/**
 * Model
 */
class Cards extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    use \Winter\Storm\Database\Traits\SoftDelete;

    public $hasMany = [
        'price_logger_relation' => 'Melvin\Mtgmoney\Models\PriceLogger'
    ];

    protected $dates = ['deleted_at'];

    /*public $hasMany = [
        'relation1' => ['Melvin\Mtgmoney\Model\PriceLogger', 'key' => 'cards_id', 'other_key' => 'id']
    ];*/

    /**
     * @var string The database table used by the model.
     */
    public $table = 'melvin_mtgmoney_cards';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];

    public function getCardBuyUrl(): string {
        $name = $this->name;
        if($this->is_booster) {
            $card_name_real = $this->ersetzeLeerzeichen($name);
            return "https://www.cardmarket.com/de/Magic/Products/Boosters/".$card_name_real."?sellerCountry=7&language=1,3&minCondition=4&isSigned=N&isPlayset=N&isAltered=N";

        }
        if($this->is_display) {
            $card_name_real = $this->ersetzeLeerzeichen($name);
            return "https://www.cardmarket.com/de/Magic/Products/Booster-Boxes/".$card_name_real."?sellerCountry=7&language=1,3&minCondition=4&isSigned=N&isPlayset=N&isAltered=N";
        }
        $card_name_real = $this->ersetzeLeerzeichen($name);
        return "https://www.cardmarket.com/de/Magic/Cards/".$card_name_real."?sellerCountry=7&language=1,3&minCondition=4&isSigned=N&isPlayset=N&isAltered=N";
    }

    public function deleteCard() {
        $price_logger = PriceLogger::where('cards_id', $this->id)->get();
        foreach($price_logger as $item) {
            $item->delete();
        }
        $this->delete();
        return true;
    }

    public static function SearchCard($card_name, $is_display = false, $is_booster = false) {
        $Cards = new Cards();
        $card_name_real = $Cards->ersetzeLeerzeichen($card_name);
        $url = "https://www.cardmarket.com/de/Magic/Cards/".$card_name_real."?sellerCountry=7&language=1,3&minCondition=4&isSigned=N&isPlayset=N&isAltered=N";
        if($is_display) {
            $url = "https://www.cardmarket.com/de/Magic/Products/Booster-Boxes/".$card_name_real."?sellerCountry=7&language=1,3&minCondition=4&isSigned=N&isPlayset=N&isAltered=N";
        }
        elseif ($is_booster) {
            $url = "https://www.cardmarket.com/de/Magic/Products/Boosters/".$card_name_real."?sellerCountry=7&language=1,3&minCondition=4&isSigned=N&isPlayset=N&isAltered=N";
        }
        $page_content = Cards::GetHTMLContent($url);
        Log::info('Search Card: '.$card_name);
        $dom = new simple_html_dom();
        $dom->load($page_content);
        $price = $dom->find('.color-primary.small.text-end.text-nowrap.fw-bold',0);
        Log::info('preis: ' . $price->innertext);
        if(isset($price->innertext)) {
            return $price->innertext;
        }
        return 0;

    }

    public static function SortByNotification($sort, $user_id = NULL) {
        if(isset($user_id)) { 
            $cards = Cards::where('user_id', $user_id)->orderBy('notification', $sort)->get();
        }
        else {
            $cards = Cards::orderBy('notification', $sort)->get();
        }
        $returnArr = [];
        foreach($cards as $item) {
            $lowest = PriceLogger::GetLowestPriceByCardId($item->id);
            $highest = PriceLogger::GetHighestPriceByCardId($item->id);
            $cardUrl = $item->getCardBuyUrl();
            $temparray['card'] = $item;
            $temparray['lowest'] = $lowest->price;
            $temparray['highest'] = $highest->price;
            $temparray['buyurl'] = $cardUrl;
            array_push($returnArr, $temparray);
        }
        return $returnArr;
    }


    public static function SortByPrice($sort, $user_id = NULL) {
        if(isset($user_id)) { 
            $cards = Cards::where('user_id', $user_id)->orderBy('price', $sort)->get();
        }
        else {
            $cards = Cards::orderBy('price', $sort)->get();
        }
        $returnArr = [];
        foreach($cards as $item) {
            $lowest = PriceLogger::GetLowestPriceByCardId($item->id, $user_id);
            $highest = PriceLogger::GetHighestPriceByCardId($item->id, $user_id);
            $cardUrl = $item->getCardBuyUrl();
            $temparray['card'] = $item;
            if(isset($lowest)) {
                $temparray['lowest'] = $lowest->price;
            }
            if(isset($highest)) {
                $temparray['highest'] = $highest->price;
            }
            $temparray['buyurl'] = $cardUrl;
            array_push($returnArr, $temparray);
        }
        return $returnArr;
    }

    public static function GetAllPricesAndCardsByID($order = NULL, $user_id = NULL) {
        if(isset($order)) {
            if(isset($user_id)) {
                $cards = Cards::where('user_id', $user_id)->orderBy('id', $order)->get();
            }
            else {
                $cards = Cards::orderBy('id', $order)->get();
            }
        }
        else {
            if(isset($user_id)) {
                $cards = Cards::where('user_id', $user_id)->get();
            }
            else {
                $cards = Cards::all();
            }
        }
        $returnArr = [];
        foreach($cards as $item) {
            $lowest = PriceLogger::GetLowestPriceByCardId($item->id, $user_id);
            $highest = PriceLogger::GetHighestPriceByCardId($item->id, $user_id);
            $cardUrl = $item->getCardBuyUrl();
            $temparray['card'] = $item;
            if(isset($lowest)) {
                $temparray['lowest'] = $lowest->price;
            }
            if(isset($highest)) {
                $temparray['highest'] = $highest->price;
            }
            $temparray['buyurl'] = $cardUrl;
            array_push($returnArr, $temparray);
        }
        return $returnArr;
    }


    public static function GetLatestUpdate($user_id = NULL) {
        if(isset($user_id)) { 
            $card = Cards::where('user_id', $user_id)->first();
        }
        else {
            $card = Cards::first();
        }
        if(isset($card)) {
            $price_logger = PriceLogger::where('cards_id', $card->id)->latest()->first();
            if(isset($price_logger)) {
                return $price_logger->created_at;
            }
        }
        return false;
    }


    public static function GetAllPricesAndCards($order = NULL, $user_id = NULL) {
        if(isset($order)) {
            if(isset($user_id)) {
                $cards = Cards::where('user_id', $user_id)->orderBy('name', $order)->get();
            }
            else {
                $cards = Cards::orderBy('name', $order)->get();
            }
        }
        else {
            if(isset($user_id)) {
                $cards = Cards::where('user_id', $user_id)->get();
            }
            else {
                $cards = Cards::all();
            }
        }
        $returnArr = [];
        foreach($cards as $item) {
            $lowest = PriceLogger::GetLowestPriceByCardId($item->id, $user_id);
            $highest = PriceLogger::GetHighestPriceByCardId($item->id, $user_id);
            $cardUrl = $item->getCardBuyUrl();
            $temparray['card'] = $item;
            if(isset($lowest)) {
                $temparray['lowest'] = $lowest->price;
            }
            if(isset($highest)) {
                $temparray['highest'] = $highest->price;
            }
            $temparray['buyurl'] = $cardUrl;
            array_push($returnArr, $temparray);
        }
        return $returnArr;
    }

    public function checkIfCardExists($name, $user_id = NULL) {
        if(isset($user_id)) {
            return Cards::where([
                ['user_id', $user_id],
                ['name', $name]
            ])->first();
        }
        return Cards::where('name', $name)->first();
    }

    public function addNewCard() {
        $price = $this->price;
        $name  = $this->name;
        $user_id = $this->user_id;
        $image = $this->getMagicCardImageURL();
        $this->image = $image;
        $this->save();
        $theCard = $this->checkIfCardExists($name, $user_id);
        $card_id = $theCard->id;
        PriceLogger::CreateNewPriceLog($price, $card_id, $user_id);
    }

    function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }


    public function getMagicCardImageURL() {
        Log::info('getMagicCardImageURL called');
        $name = $this->name;
        $cardName = urlencode($name);
        $apiUrl = "https://api.scryfall.com/cards/named?exact={$cardName}";
        //print_r($apiUrl);
        if(self::get_http_response_code($apiUrl) != "200"){
            return null;
        }

        // API-Aufruf durchführen
        $response = file_get_contents($apiUrl);
        $jsonData = json_decode($response, true);

        if ($jsonData && isset($jsonData['image_uris']['normal'])) {
            return $jsonData['image_uris']['normal'];
        } else {
            return null;
        }
    }

    public static function GetCardById($id) {
        return Cards::where('id', $id)->first();
    }

    public static function TransformPrice($price) {
        // Währungssymbol entfernen
        $string = str_replace(" €", "", $price);

        // Dezimaltrennzeichen anpassen
        $string = str_replace(",", ".", $string);

        // Ergebnis
        return (double) $string;
    }

    public static function MakePriceGreatAgain($price) {
        $float = (float) $price; // String in eine Gleitkommazahl umwandeln
        $formatted = number_format($float, 2, ',', '.'); // Formatierung der Zahl mit Tausendertrennzeichen und Dezimalpunkt
        return sprintf("%s€", $formatted); // Hinzufügen des Euro-Zeichens
    }


    function ersetzeLeerzeichen($string) {
        $result = ltrim($string);
        $result = str_replace("'", "", $result);
        $result = str_replace(' ', '-', $result);
        $result = str_replace(':', '', $result);
        return str_replace(',', '', $result);
    }


    public static function GetHTMLContent($url) {
        $data = array(
            "url" => $url
        );
        $node_url = "http://node-api:3000/invokeFunction";  // Use the container name as the hostname

        $options = [
            CURLOPT_URL => $node_url,
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
        /*$curl = curl_init();

        // Setze die cURL-Optionen
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36');

        // Führe die Anfrage aus
        $response = curl_exec($curl);

        // Überprüfe auf Fehler
        if ($response === false) {
            curl_close($curl);
            return false; // Fehler beim Abrufen der Seite
        }

        // Schließe die cURL-Verbindung
        curl_close($curl);

        // Verarbeite die Seite mit einer HTML-Parsing-Bibliothek (z.B. SimpleHTMLDom)
        // ...*/

        return $result['result']; // Gib den Seiteninhalt zurück
    }


}
