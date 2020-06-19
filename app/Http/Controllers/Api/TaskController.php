<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        if (null != $request->id) {
            $arr = Task::with(['progress', 'employees'])->where("id", $request->id)->first();
            return ResponseHelper::success($arr);
        }
        return ResponseHelper::success(Task::with(['progress', 'employees'])->get());
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
        $data      = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'title'       => 'required|min:10|max:100',
                'description' => 'required|min:10|max:100',
                'progress_id' => "required|integer|min:1|max:3"
            ]
        );

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }


        $task              = new Task();
        $task->title       = $data['title'];
        $task->description = $data['description'];
        $task->progress_id = $data['progress_id'];
        $task->save();
        $task->employees()->sync($data['employees']);
        $task->save();
        return ResponseHelper::success(array());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $data      = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'title'       => 'required|min:10|max:100',
                'description' => 'required|min:10|max:100',
                'progress_id' => "required|integer|min:1|max:3"
            ]
        );

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }


        $task->title       = $data['title'];
        $task->description = $data['description'];
        $task->progress_id = $data['progress_id'];
        $task->save();
        $task->employees()->sync($data['employees']);
        $task->save();

        return ResponseHelper::success(array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
