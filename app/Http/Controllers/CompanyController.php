<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Helper\ImageUpload;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ImageUpload;
    public function index()
    {
        $companies = Company::latest()->where('isDeleted','0')->paginate(10);

        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'nullable|email|unique:companies'
        ]);
        $image = '';
        if($file = $request->file('image')) {
            $fileData = $this->uploads($file, 'storage/app/public/');

            if(!empty($fileData))
                $image = $fileData['fileName'];

        }
        $request['logo'] = $image;
        Company::create($request->all());

        return redirect()->route('companies.index')
            ->with('success','Comapany created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'nullable|email'

        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')
            ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->update(['isDeleted'=>'1']);
        return redirect()->route('companies.index')
            ->with('success','Company deleted successfully');
    }
    public function recycledata()
    {
        $companies = Company::latest()->where('isDeleted','1')->paginate(10);

        return view('companies.recycle',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function active($id)
    {
        $data = Company::where('id',$id)->update(['isDeleted'=>'0']);
        return redirect()->route('companies.index')
            ->with('success','Company actived successfully');
    }
}
