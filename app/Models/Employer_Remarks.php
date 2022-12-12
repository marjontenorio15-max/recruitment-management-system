<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer_Remarks extends Model
{
    use HasFactory;

    protected $table = 'employer_remarks';
    protected $fillable = [
        'applicant_id', 'remarks'
    ];
}
