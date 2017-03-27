<?php

namespace Api\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Api\Repositories\Contracts\KitRepositoryContract;
use Api\Models\Kit;

/**
 * Class KitRepository
 * @package Api\Repositories
 */
class KitRepository implements KitRepositoryContract
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return response()->json([
            'result' => [
                'status' => 200,
                'data' => Kit::orderBy('name', 'asc')->get()
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
                    'data' => Kit::findOrFail($id)]
            ], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'message' => 'kit not found']
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
                    'data' => Kit::create($request->all())
                ]
            ], 201);
        } catch (QueryException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'kit not was created'
                ]
            ], 400);
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
            $user = Kit::findOrFail($id);
            $user->update($request->all());
            return response()->json(204);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'kit not found'
                ]
            ], 400);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            Kit::destroy(explode(',', $id));
            return response()->json(204);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'kit not removed'
                ]
            ], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConstructionsByKit($id)
    {
        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'data' => Kit::find($id)->constructions
                ]
            ], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'Kit not found'
                ]
            ], 400);
        }
    }
}