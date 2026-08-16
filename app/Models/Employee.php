<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employer';

    protected $fillable = [
        'company_id', 'company_name', 'email', 'username', 'password', 'contact_no',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password)
            : $password;
    }
}
