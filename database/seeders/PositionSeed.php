<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Position::create([
        'name'=>'CEO',
        'Salary'=>3000,
       ]);
       Position::create([
        'name'=>'CTO',
        'Salary'=>4000,
       ]);
       Position::create([
        'name'=>'Accounting',
        'Salary'=>2500,
       ]);
       Position::create([
        'name'=>'Project_Manger',
        'Salary'=>5000,
       ]);
       Position::create([
        'name'=>'Team_Leader',
        'Salary'=>5000,
       ]);
      
    }
}
