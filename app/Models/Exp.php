<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exp extends Model
{
    use HasFactory;
    protected $table = 'experience';
    protected $fillable = [
     'applicant_id', 'job_title', 'company_name', 'period_employed', 'achievements', 'certificate'
    ];
}
