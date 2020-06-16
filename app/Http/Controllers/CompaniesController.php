<?php

namespace App\Http\Controllers;

use App\Http\Resources\Company as ResourcesCompany;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyCollection;

class CompaniesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->sendResponse(new CompanyCollection(Company::all()), 'Company list sent successfully.');
    }

    public function test($id)
    {
        return $this->sendResponse(new ResourcesCompany(Company::findOrFail($id)), 'Company list sent successfully.');

        // return $this->sendResponse(Company::findOrFail($id), 'Company list sent successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyRequest $request)
    {
        //
        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address
        ]);
        if($file = $request->file('logo')) {
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $company->logo()->create([
                'path' => $name
            ]);
        }

        return $this->sendResponse(new ResourcesCompany($company), 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
