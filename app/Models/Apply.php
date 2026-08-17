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
class Apply extends Model
{
    use HasFactory;

    protected $table = 'apply';

    protected $fillable = [
        'job_id', 'applicant_id', 'remarks', 'description',
    ];
}
