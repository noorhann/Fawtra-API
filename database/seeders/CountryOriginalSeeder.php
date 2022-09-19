<?php

namespace Database\Seeders;

use App\Models\CountryOriginal;
use Illuminate\Database\Seeder;

class CountryOriginalSeeder extends Seeder
{
    
    public function run()
    {
        CountryOriginal::create ([
            'country'=>'china',
        ]);

        CountryOriginal::create ([
            'country'=>'Japan',
        ]);

        CountryOriginal::create ([
            'country'=>'Germany',
        ]);

        CountryOriginal::create ([
            'country'=>'United States of America',
        ]);

        CountryOriginal::create ([
            'country'=>'South Korea',
        ]);
    }
}
