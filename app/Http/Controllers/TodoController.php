<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $todos = Todo::get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'todos' => $todos
        ], 200);
    }
    
    /**
     * create
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        Todo::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'amount' => $request['amount'],
            'price' => $request['price']
        ]);

        $todos = Todo::get();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully created',
            'todos' => $todos
        ], 200);
    }
    
    /**
     * edit
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function edit(Request $request): JsonResponse
    {
        Todo::find($request['id'])
                ->update([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'amount' => $request['amount'],
                    'price' => $request['price']
                ]);
        
        $todos = Todo::get();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully updated',
            'todos' => $todos
        ], 200);
    }
    
    /**
     * remove
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function remove(Request $request): JsonResponse
    {
        Todo::find($request['id'])->delete();

        $todos = Todo::get();
        return response()->json([
            'status' => true,
            'message' => 'Product successfully deleted',
            'todos' => $todos
        ], 200);
    }
}
