<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies=Company::paginate(request()->all());

        return response()->json(['data'=>$companies],200);
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
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'email',

        ]);
        $company = new Company();

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->telephone = $request->input('telephone');
        $company->logo = $request->input('logo');
        $company->cover_image = $request->input('cover_image');
        $company->website = $request->input('website');
        $company->other_information = $request->input('other_information');

        $company->save();

        return response()->json( ['message'=>'Company Added Successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::where('id',$id)->first();

        if($company){
            return response()->json( ['company'=>$company],200);
        }
        else{
            return response()->json( ['message'=>'Company is not found'],404);
        }
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
        $request->validate([
            'name' => 'required',
            'email' => 'email',
        ]);
        $company = Company::find($id);
        if($company){

            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->telephone = $request->input('telephone');
            $company->logo = $request->input('logo');
            $company->cover_image = $request->input('cover_image');
            $company->website = $request->input('website');
            $company->other_information = $request->input('other_information');

            $company->update();

            return response()->json( ['message'=>'Company updated successfully'],200);
        }
        else{
            return response()->json( ['message'=>'Company is not found'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company){

            $company->delete();

            return response()->json( ['message'=>'Company Deleted Successfully'],200);
        }
        else{
            return response()->json( ['message'=>'Company is not found'],404);
        }

    }
}
