<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = ['role', 'permission', 'is_active'];

    public static function isAllowed(string $role, string $permission): bool
    {
        $record = self::where('role', $role)
                      ->where('permission', $permission)
                      ->first();

        return $record ? (bool) $record->is_active : true;
    }
}