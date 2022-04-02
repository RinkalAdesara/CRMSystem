<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {

//        $employees = Employee::latest()->where('isDeleted','0')->paginate(10);
        $employees = Employee::leftJoin('companies', 'companies.id', '=', 'employees.company_id')
                    ->select('employees.*','companies.name as companyname')
                    ->latest()->where('employees.isDeleted','0')->limit(10)->get();
//dd($employees[0]);

        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::where('isDeleted','0')->get();
        return view('employees.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phoneno' =>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'nullable|email|unique:employees',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success','Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $Employee)
    {
        return view('employees.show',compact('Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $Employee)
    {
        $company = Company::where('isDeleted','0')->get();
        return view('employees.edit',compact('Employee','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $Employee)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phoneno' =>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
//            'email' => 'email|unique:employees',
        ]);

        $Employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $Employee)
    {
        $Employee->update(['isDeleted'=>'1']);
        return redirect()->route('employees.index')
            ->with('success','Employee deleted successfully');
    }

    public function recycledata()
    {

//        $employees = Employee::latest()->where('isDeleted','0')->paginate(10);
        $employees = Employee::leftJoin('companies', 'companies.id', '=', 'employees.company_id')
            ->select('employees.*','companies.name as companyname')
            ->latest()->where('employees.isDeleted','1')->limit(10)->get();
//dd($employees[0]);

        return view('employees.recycle',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function active($id)
    {
        $data = Employee::where('id',$id)->update(['isDeleted'=>'0']);
        return redirect()->route('employees.index')
            ->with('success','Employee actived successfully');
    }

}
