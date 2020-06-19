<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (null != $request->id) {
            $arr = Employee::with(['tasks'])->where("id", $request->id)->first();
            return ResponseHelper::success($arr);
        }
        return ResponseHelper::success(Employee::with(['tasks'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(
            [
                'fullName' => 'required|min:10|max:100',
                'image'    => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ]
        );

        $employee           = new Employee();
        $employee->fullName = $request->fullName;

        if ($request->hasFile('image')) {
            $imageName       = time() . '.' . $request->image->getClientOriginalExtension();
            $employee->image = URL::to('/') . '/assets/images/employee/' . $imageName;
            $request->image->move(public_path('assets/images/employee'), $imageName);
        }

        $employee->save();
        $employee->tasks()->sync($request->tasks);
        $employee->save();
        return ResponseHelper::success(array());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Employee $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate(
            [
                'fullName' => 'required|min:10|max:100',
                'image'    => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
            ]
        );


        $employee->fullName = $request->fullName;

        if ($request->hasFile('image')) {
            $image_path = public_path($employee->image);
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $imageName       = time() . '.' . $request->image->getClientOriginalExtension();
            $employee->image = URL::to('/') . '/assets/images/employee/' . $imageName;
            $request->image->move(public_path('assets/images/employee'), $imageName);
        }
        $employee->save();
        $employee->tasks()->sync($request->tasks);
        $employee->save();
        return ResponseHelper::success(array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
