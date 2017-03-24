<?php

namespace Api\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Api\Repositories\Contracts\WorkRepositoryContract;
use Api\Models\Work;
use Api\Models\User;

/**
 * Class WorkRepository
 * @package Api\Repositories
 */
class WorkRepository implements WorkRepositoryContract
{
    public function __construct()
    {
//        $this->middleware('JWT.auth')->only('index', 'create', 'update', 'destroy');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return response()->json([
            'result' => [
                'status' => 200,
                'data' => Work::orderBy('name', 'asc')->get()
            ]
        ], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function read($id)
    {
        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'data' => Work::findOrFail($id)]
            ], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'message' => 'user not found']
            ], 404);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($request)
    {
        try {
            return response()->json([
                'result' => [
                    'status' => 201,
                    'data' => Work::create($request->all())
                ]
            ], 201);
        } catch (QueryException $error) {
            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => 'user not was created'
                ]
            ], 500);
        }
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, $request)
    {
        try {
            $user = Work::findOrFail($id);
            $user->update($request->all());
            return response()->json(204);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 404,
                    'message' => 'work not found'
                ]
            ], 404);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            Work::destroy(explode(',', $id));
            return response()->json(204);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 204,
                    'message' => 'work not removed'
                ]
            ], 404);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWorksByUser($id)
    {
        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'data' => User::find($id)->works
                ]
            ], 201);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 401,
                    'message' => 'work not found'
                ]
            ], 404);
        }
    }
}