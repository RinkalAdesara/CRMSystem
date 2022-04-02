<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname','lastname','email','phoneno','company_id','isActive','isDeleted'
    ];

//    public function company(){
//        $this->belongsTo(Company::class);
//    }
}
