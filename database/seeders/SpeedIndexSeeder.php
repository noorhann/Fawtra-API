<?php

namespace Database\Seeders;

use App\Models\SpeedIndex;
use Illuminate\Database\Seeder;

class SpeedIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpeedIndex::create ([
            'speed'=>'H:to 130 mph',
        ]);

        SpeedIndex::create ([
            'speed'=>'Q:to 99 mph',
        ]);

        SpeedIndex::create ([
            'speed'=>'V:to 149 mph',
        ]);

        SpeedIndex::create ([
            'speed'=>'W:to 168 mph',
        ]);

        SpeedIndex::create ([
            'speed'=>'Y:to 186 mph',
        ]);

        SpeedIndex::create ([
            'speed'=>'Zr:to 150-168 mph',
        ]);

    }
}
