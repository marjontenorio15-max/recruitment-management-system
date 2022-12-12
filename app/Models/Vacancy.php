<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vacancy extends Model
{
use HasFactory;

    protected $table = 'tbl_job_list';
    protected $fillable = [
    'title', 'company_id', 'created_by',
//        'job_details',
        'no_of_employee', 'salary',
//        'duration_employment',
        'sex',
        'degree',
//        'section_vacancy',
        'work_exp', 'job_desc', 'location'
];

}
