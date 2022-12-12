<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $table = 'educational_background';
    protected $fillable = [
        'applicant_id','school_name', 'school_location', 'degree', 'field_of_study','month_graduate','year_graduate',
    ];
}
