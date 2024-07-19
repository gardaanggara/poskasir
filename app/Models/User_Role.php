<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;
use App\Models\User;

class User_Role extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function user()
    {
        return $this->belongsTo(Modules::class, 'user_id');
    }
}
