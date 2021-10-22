<?php

namespace App\Models;

use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $collection = 'settings';
    protected $connection = 'mongodb';

    protected $fillable = ['key', 'value'];
    
    // Setting::get('currency_symbol'); and you get Kn
    public static function get($key) {
        $setting =new self();
        $entry = $setting->where('key', $key)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }

    public static function set($key, $value = null) {
        $setting = new self();
        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();
        Config::set('key', $value);
        if (Config::get($key) == $value) {
            return true;
        }
        return false;
    }
}
