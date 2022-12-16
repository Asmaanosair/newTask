<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\SalaryDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Employee $employee)
    {

        $data=$employee->with('department.salarySpecified')->get();
        return view('welcome',['data'=>$data]);

    }



}
