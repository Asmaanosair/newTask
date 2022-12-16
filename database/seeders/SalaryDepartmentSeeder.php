<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments=Department::all()->chunk(3);
        $salaries=Salary::all()->chunk(3);
        foreach ($salaries as $key=>$salary){
            foreach($salary as $item) {
                foreach ($departments as $keyDepart => $department) {
                    if ($key == $keyDepart) {
                        $item->department()->syncWithoutDetaching(array_column($department->toArray(), 'id'));
                    }
                }
            }
        }
    }
}
