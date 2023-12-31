<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakits = Penyakit::all();

        for ($i = 0; $i < 10; $i++) {
            Obat::create([
                'title' => "obat $i",
                'description' => "obat $i",
                'penyakit_id' => $penyakits->random()->id
            ]);
        }
    }
}
