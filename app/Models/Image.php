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
class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $fillable = ['name', 'file_path', 'applicant_id', 'created_at', 'updated_at'];
}
