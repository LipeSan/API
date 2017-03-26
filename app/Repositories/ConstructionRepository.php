<?php

namespace Api\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Api\Repositories\Contracts\ConstructionRepositoryContract;
use Api\Models\Construction;
use Api\Models\User;

/**
 * Class WorkRepository
 * @package Api\Repositories
 */
class ConstructionRepository implements ConstructionRepositoryContract
{
    /**
     * ConstructionRepository constructor.
     */
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
                'data' => Construction::orderBy('name', 'asc')->get()
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
                    'data' => Construction::findOrFail($id)]
            ], 200);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'message' => 'construction not found']
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
                    'data' => Construction::create($request->all())
                ]
            ], 201);
        } catch (QueryException $error) {
            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => 'construction not was created'
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
            $user = Construction::findOrFail($id);
            $user->update($request->all());
            return response()->json(204);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 404,
                    'message' => 'construction not found'
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
            Construction::destroy(explode(',', $id));
            return response()->json(204);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 204,
                    'message' => 'construction not removed'
                ]
            ], 404);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConstructionsByUser($id)
    {
        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'data' => User::find($id)->constructions
                ]
            ], 201);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 401,
                    'message' => 'construction not found'
                ]
            ], 404);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKitsByConstruction($id)
    {
        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'data' => Construction::find($id)->kits
                ]
            ], 201);
        } catch (ModelNotFoundException $error) {
            return response()->json([
                'error' => [
                    'status' => 401,
                    'message' => 'Construction not found'
                ]
            ], 404);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addKit($request)
    {
        $kits = $request->all();

        try {
            foreach ($kits as $kit) {
                Construction::findOrFail($kit['construction_id'])
                    ->kits()
                    ->attach($kit['kit_id'], ['quantity' => $kit['quantity']]
                );
            }

            return response()->json([
                'result' => [
                    'status' => 201,
                ]
            ], 201);
        } catch (QueryException $error) {
            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => 'not associated kit'
                ]
            ], 500);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeKit($request)
    {
        $kits = $request->all();

        try {
            Construction::findOrFail($kits['construction_id'])
                ->kits()
                ->detach($kits['kit_id']
                );

            return response()->json([
                'result' => [
                    'status' => 201
                ]
            ], 201);
        } catch (QueryException $error) {
            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => 'associate kit not removed'
                ]
            ], 500);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function synckits($request)
    {
        $kits = $request->all();

        try {
            foreach ($kits as $kit) {
                Construction::findOrFail($kit['construction_id'])
                    ->kits()
                    ->detach();
            }

            foreach ($kits as $kit) {
                Construction::findOrFail($kit['construction_id'])
                    ->kits()
                    ->attach($kit['kit_id'], ['quantity' => $kit['quantity']]
                    );
            }
            return response()->json([
                'result' => [
                    'status' => 201,
                ]
            ], 201);
        } catch (QueryException $error) {
            return response()->json([
                'error' => [
                    'status' => 500,
                    'message' => 'associate kits not sincronized'
                ]
            ], 500);
        }
    }
}