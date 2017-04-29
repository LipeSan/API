<?php

namespace Api\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Api\Repositories\Contracts\ConstructionRepositoryContract;
use Api\Models\Construction;
use Api\Models\User;
use DB;

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
        $constructions = Construction::orderBy('name', 'asc')->get();

        foreach ($constructions as $index => $construction) {
            $constructions[$index]['totalKit'] = DB::table('construction_kit')->where('construction_id', '=', $construction->id)->get()->count();
        }

        return response()->json([
            'result' => [
                'status' => 200,
                'data' => $constructions
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
                    'status' => 400,
                    'message' => 'construction not was created'
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
                    'status' => 400,
                    'message' => 'construction not removed'
                ]
            ], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConstructionsByUser($id)
    {
        $constructions = User::find($id)->constructions;

        foreach ($constructions as $index => $construction) {
            $constructions[$index]['totalKit'] = DB::table('construction_kit')->where('construction_id', '=', $construction->id)->get()->count();
        }

        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'data' => $constructions
                ]
            ], 201);
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
                    'status' => 404,
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
            if(key_exists('quantity', $kits)) {
                Construction::findOrFail($kits['construction_id'])
                    ->kits()
                    ->attach($kits['kit_id'], ['quantity' => $kits['quantity']]);
            } else {
                Construction::findOrFail($kits['construction_id'])
                    ->kits()
                    ->attach($kits['kit_id']);
            }

            return response()->json([
                'result' => [
                    'status' => 201,
                ]
            ], 201);
        } catch (\ErrorException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'not associated kit'
                ]
            ], 400);
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
        } catch (\ErrorException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'associate kit not removed'
                ]
            ], 400);
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
            foreach ($kits as $key => $kit) {
                Construction::findOrFail($kit['construction_id'])
                    ->kits()
                    ->detach();
            }

            foreach ($kits as $key => $kit) {
                if(key_exists('quantity', $kits[$key])) {
                    Construction::findOrFail($kit['construction_id'])
                        ->kits()
                        ->attach($kit['kit_id'], ['quantity' => $kit['quantity']]);
                } else {
                    Construction::findOrFail($kit['construction_id'])
                        ->kits()
                        ->attach($kit['kit_id']);
                }

            }
            return response()->json([
                'result' => [
                    'status' => 201,
                ]
            ], 201);
        } catch (\ErrorException $error) {
            return response()->json([
                'error' => [
                    'status' => 400,
                    'message' => 'associate kits not sincronized'
                ]
            ], 400);
        }
    }
}