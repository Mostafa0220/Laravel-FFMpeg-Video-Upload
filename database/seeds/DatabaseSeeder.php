<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            'id' => 18,
            'title' => 'Earth',
            'original_name' => 'file_example_MP4_1920_18MG.mp4',
            'disk' => 'videos_disk',
            'path' => 'videos/z9CPpRtiTSi5Ye9hr9XmRPX7NLuiewPSANgMaBcY.mp4',
            'converted_for_downloading_at' => '2021-06-20 17:55:41'
        ]);
        DB::table('videos')->insert([
            'id' => 19,
            'title' => 'Carton',
            'original_name' => 'sample-mp4-file.mp4',
            'disk' => 'videos_disk',
            'path' => 'videos/JD6ffYklGRqRG6OJ3b2BtSNrY01QmoQFene9MrhO.mp4',
            'converted_for_downloading_at' => '2021-06-20 17:55:41'
        ]);
    }
}
