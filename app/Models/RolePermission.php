<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
     protected $primaryKey = 'permission_id';

    protected $fillable = [
        'role_id',
        'description',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'role_id');
    }
}
