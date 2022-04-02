<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','website','logo','isActive','isDeleted'
    ];

//    public function employee(){
//        return $this->hasOne(Employee::class);
//    }
}
