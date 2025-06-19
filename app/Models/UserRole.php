<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'user_id',
        'role_name',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'role_id');
    }
}
