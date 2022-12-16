<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
      public function department(){
          return $this->belongsToMany(Department::class,'employee_departments','department_id','employee_id');
      }

}
