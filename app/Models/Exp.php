<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 * @mixin Model
 * @mixin \Illuminate\Database\Query\Builder
 */
class Exp extends Model
{
    use HasFactory;

    protected $table = 'experience';

    protected $fillable = [
        'applicant_id', 'job_title', 'company_name', 'period_employed', 'achievements',
    ];
}
