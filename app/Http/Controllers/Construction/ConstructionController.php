<?php

namespace Api\Http\Controllers\Construction;

use Api\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\Api\Repositories\ConstructionRepository;

class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConstructionRepository::getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ConstructionRepository::create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Api\Construction  $Construction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ConstructionRepository::read($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Api\Construction  $Construction
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        return ConstructionRepository::update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Api\Construction  $Construction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ConstructionRepository::delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getConstructionsByUser($id)
    {
        return ConstructionRepository::getConstructionsByUser($id);
    }
}
