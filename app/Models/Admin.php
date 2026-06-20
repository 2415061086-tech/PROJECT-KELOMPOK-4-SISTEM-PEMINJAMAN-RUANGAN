<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $rememberTokenName = false;

    protected $fillable = ['nama', 'email', 'password'];

    protected $hidden = ['password'];

    public function persetujuan() {
        return $this->hasMany(Persetujuan::class, 'id_admin');
    }
}