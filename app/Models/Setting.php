<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'settings';
    protected $fillable = ['key', 'value', 'label', 'keterangan'];

    // Ambil value by key
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Ambil sebagai integer
    public static function getInt(string $key, int $default = 0): int
    {
        return (int) static::get($key, $default);
    }

    // Ambil sebagai array (untuk yang dipisah koma)
    public static function getArray(string $key, array $default = []): array
    {
        $value = static::get($key);
        if (!$value) return $default;
        return array_map('trim', explode(',', $value));
    }
}