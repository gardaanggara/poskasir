<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;
use App\Models\Modules;

class User_Privs extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'role_id',
        'module_id'
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function module()
    {
        return $this->belongsTo(Modules::class, 'module_id');
    }
}
