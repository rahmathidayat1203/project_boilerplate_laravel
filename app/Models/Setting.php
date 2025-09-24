<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'string',
    ];
    
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }
        
        // Cast the value based on its type
        switch ($setting->type) {
            case 'integer':
                return (int) $setting->value;
            case 'boolean':
                return (bool) $setting->value;
            case 'double':
                return (float) $setting->value;
            default:
                return $setting->value;
        }
    }
    
    /**
     * Set a setting value by key
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $type = gettype($value);
        
        self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type
            ]
        );
    }
    
    /**
     * Get the options for logging activity.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
