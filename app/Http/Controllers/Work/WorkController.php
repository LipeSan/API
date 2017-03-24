<?php

namespace Api\Http\Controllers\Work;

use Api\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\Api\Repositories\WorkRepository;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WorkRepository::getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return WorkRepository::create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Api\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return WorkRepository::read($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Api\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        return WorkRepository::update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Api\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return WorkRepository::delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getWorksByUser($id)
    {
        return WorkRepository::getWorksByUser($id);
    }
}
