<?php namespace Melvin\Mtgmoney\Models;

use Model;

/**
 * Model
 */
class MTGJson extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    use \Winter\Storm\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];
    private static $jsonurl = 'https://mtgjson.com/api/v5/AllPrintings.json';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'melvin_mtgmoney_mtgjson';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];

    public function checkExistence() {
        $name = $this->name;
        $set = $this->set;
        $entry = MTGJson::where([
            ['set', $set],
            ['name', $name]
        ])->first();
        if(isset($entry)){
            return true;
        }
        return false;
    }

    public static function getMTGJson() {
        $apiUrl = self::$jsonurl;
        $jsonData = file_get_contents($apiUrl);
        $data = json_decode($jsonData, true);
        foreach ($data['data'] as $set => $setData) {
            foreach ($setData['cards'] as $cardData) {
                $item = new MTGJson();
                echo $cardData['name']."\n";
                $item->name = $cardData['name'];
                $item->type = $cardData['type'];
                $item->set = $setData['name'];
                $exists = $item->checkExistence();
                if(!$exists) {
                    $item->save();
                }
            }
        }
    }

    public static function GetAllSetsByCardName($name) {
        $entry = MTGJson::where([
            ['name', $name]
        ])->orderBy('set', 'asc')->get();
        if(isset($entry)){
            return $entry;
        }
        return false;
    }

    public function autocomplete() {
        $search = post('term');
        $cards = Autocomplete::where('name', 'LIKE', '%'.$search.'%')->get();
        $return = array();
        foreach($cards as $item) {
            array_push($return, $item->name);
        }
        return $return;
    }

}
