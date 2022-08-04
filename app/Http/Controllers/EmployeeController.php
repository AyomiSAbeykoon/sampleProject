<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
        $employees=Employee::paginate(request()->all());

        return response()->json(['data'=>$employees],200);
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
            'first_name'=>'required',
            'last_name'=>'required',

        ]);
        $employee = new Employee();

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->profile_photo = $request->input('profile_photo');

        $employee->save();

        return response()->json( ['message'=>'Employee Added Successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id',$id)->first();

        if($employee){
            return response()->json( ['employee'=>$employee],200);
        }
        else{
            return response()->json( ['message'=>'Employee is not found'],404);
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
            'first_name'=>'required',
            'last_name'=>'required',
        ]);

        $employee = Employee::find($id);
        if($employee){

            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->company_id = $request->input('company_id');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->profile_photo = $request->input('profile_photo');

            $employee->update();

            return response()->json( ['message'=>'Employee updated successfully'],200);
        }
        else{
            return response()->json( ['message'=>'Employee is not found'],404);
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
        $employee = Employee::find($id);
        if($employee){

            $employee->delete();

            return response()->json( ['message'=>'Employee Deleted Successfully'],200);
        }
        else{
            return response()->json( ['message'=>'Employee is not found'],404);
        }
    }
}
