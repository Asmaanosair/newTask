<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\SalaryDepartment;
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
         \App\Models\User::factory(10)->create();
        \App\Models\Employee::factory(10)->create();
        \App\Models\Department::factory(10)->create();
        \App\Models\Salary::factory(10)->create();
        // add Dummy Data to Employee Departments
        $departments=Department::all()->chunk(3);
        $employees=Employee::all()->chunk(3);
        foreach ($employees as $key=>$employee){
            foreach($employee as $item) {
                foreach ($departments as $keyDepart => $department) {
                    if ($key == $keyDepart) {
                        $item->department()->syncWithoutDetaching(array_column($department->toArray(), 'id'));
                    }
                }
            }
        }
        // add Dummy Data to Salary Departments
        $salaries=Salary::all()->chunk(3);
        foreach ($departments as $key=>$department){
            foreach($department as $item) {
                foreach ($salaries as $keySalary => $salary) {
                    if ($key == $keySalary) {
                        $item->salary()->syncWithoutDetaching(array_column($salary->toArray(), 'id'));
                    }
                }
                $specifiedSalary=SalaryDepartment::where('department_id',$item->id)->first();
                $specifiedSalary->specified="1";
                $specifiedSalary->save();
            }
        }
        
    }
}
