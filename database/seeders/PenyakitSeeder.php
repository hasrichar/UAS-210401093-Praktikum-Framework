<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakits = ['flu', 'sakit kepala', 'sakit gigi', 'sakit mulut', 'sakit gigi', 'sakit mulut', 'sakit gigi', 'sakit mulut', 'sakit gigi', 'sakit mulut'];
            foreach ($penyakits as $penyakit){
                Penyakit::create([
                    'name' => $penyakit,
                ]);
            }
    }
}
