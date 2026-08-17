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
class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'company_id', 'company_name', 'address', 'contact_no',
    ];
}
