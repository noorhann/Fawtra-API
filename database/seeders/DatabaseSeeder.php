<?php

namespace Database\Seeders;

use App\Models\CountryOriginal;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            $this->call([
            
                //WidthSeeder::class,
                // HeightSeeder::class
                //WeekSeeder::class,
                //YearSeeder::class,
                //BrandSeeder::class,
                //CountryOriginalSeeder::class,
                //SpeedIndexSeeder::class,
                //LocationSeeder::class,
            ]);
    }
}
