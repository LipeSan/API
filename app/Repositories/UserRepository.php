<?php

namespace Api\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Api\Repositories\Contracts\UserRepositoryContract;
use Api\Models\User;
use Illuminate\Database\QueryException;

/**
 * Class UserRepository
 * @package Api\Repositories
 */
class UserRepository implements UserRepositoryContract
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return response()->json(User::all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findOne($id)
    {
        try {
            return response()->json(['success' => true, 'data' => User::findOrFail($id)], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json(['error' => true, 'message' => 'user_not_found'], 404);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($request)
    {
        $request['password'] = bcrypt($request->password);
        try {
            return response()->json(['success' => true, 'data' => User::create($request->all())], 201);
        } catch (QueryException $error) {
            return response()->json(['error' => true, 'message' => 'user_not_was_created'], 500);
        }
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, $request)
    {
        $request['password'] = bcrypt($request->password);
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json(['success' => true, 'data' => $user], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json(['error' => true, 'message' => 'user_not_found'], 404);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            return response()->json(['success' => true, 'data' => $user], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json(['error' => true, 'message' => 'user_not_removed'], 401);
        }
    }
}