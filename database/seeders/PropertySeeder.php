<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'title'=> Str::random(12),
            'bedrooms'=> Str::random(2),
             'bathrooms'=> Str::random(2),
             'price'=> Str::random(2),
             'address'=> Str::random(2),
             'user_id'=> Str::random(2),
        ]);
    }
}
