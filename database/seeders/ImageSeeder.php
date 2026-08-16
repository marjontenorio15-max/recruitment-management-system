<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $applicant = Applicant::where('email_address', 'applicant@example.com')->firstOrFail();

        Image::updateOrCreate(
            ['applicant_id' => $applicant->applicant_id],
            ['name' => 'Default profile image', 'file_path' => null]
        );
    }
}
