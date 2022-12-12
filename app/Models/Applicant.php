<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = 'applicants';
    protected $fillable = [
        'applicant_id', 'job_id',
        'first_name', 'last_name',
        'middle_name',

        'street_address',
        'city',
        'state',
        'zipcode',

        'sex', 'civil_status',
        'birth_date', 'birth_place', 'age',
//        'user_name', 'password',
        'email_address',
        'remarks',
        'contact_no', 'degree', 'file_attachment'
    ];
}
