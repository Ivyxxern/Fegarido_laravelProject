<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::create(['brand_name' => 'Bianchi']);
        Brand::create(['brand_name' => 'Cannondale']);
        Brand::create(['brand_name' => 'Trek']);
        Brand::create(['brand_name' => 'Trinx']);
        Brand::create(['brand_name' => 'Scott']);
        Brand::create(['brand_name' => 'Specialized']);

    }
}

