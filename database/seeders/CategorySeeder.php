<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create(['name' => 'Cookware']);
        Category::factory()->create(['name' => 'Tableware & Serveware']);
        Category::factory()->create(['name' => 'Bakeware']);
        Category::factory()->create(['name' => 'Storage & Organization']);
        Category::factory()->create(['name' => 'Kitchen Appliances']);
        Category::factory()->create(['name' => 'Utensils & Tools']);
    }
}
