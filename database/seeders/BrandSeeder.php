<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->create(['name' => 'Dorsch']);
        Brand::factory()->create(['name' => 'Karout-Lex']);
        Brand::factory()->create(['name' => 'Phoenix']);
        Brand::factory()->create(['name' => 'Lomenox']);
        Brand::factory()->create(['name' => 'Momaz']);
        Brand::factory()->create(['name' => 'Others']);
    }
}
