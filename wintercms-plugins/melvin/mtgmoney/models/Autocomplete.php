<?php namespace Melvin\Mtgmoney\Models;

use Model;

/**
 * Model
 */
class Autocomplete extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'melvin_mtgmoney_autocomplete';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];


    public static function createAutocompletes() {
        $data = MTGJson::all();
        foreach($data as $item) {
            $exists  = Autocomplete::where('name', $item->name)->first();
            if(!isset($exists)){
                echo $item->name."\n";
                $auto = new Autocomplete();
                $auto->name = $item->name;
                $auto->save();
            }

        }
    }


}
