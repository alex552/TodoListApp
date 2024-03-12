<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * @return TodoResource::collection
     */
    public function index()
    {
        $todos = Todo::all();
        return TodoResource::collection($todos);
    }

    /**
     * @param StoreTodoRequest $request
     * @return TodoResource
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = Todo::create($request->all());
        return new TodoResource($todo);
    }

    /**
     * @param Todo $todo
     * @return TodoResource
     */
    public function show(Todo $todo)
    {
        return TodoResource::make($todo);
    }

    /**
     * @param UpdateTodoRequest $request
     * @param Todo $todo
     * @return TodoResource
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->all());
        return TodoResource::make($todo);
    }

    /**
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204);
    }
}
