<?php

namespace Api\Http\Controllers\Kit;

use Illuminate\Http\Request;
use Api\Http\Controllers\Controller;
use Facades\Api\Repositories\KitRepository;

/**
 * Class KitController
 * @package Api\Http\Controllers\Kit
 */
class KitController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return KitRepository::getAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return KitRepository::read($id);
    }

    /**
     * @param \Api\Http\Controllers\\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return KitRepository::create($request);
    }

    /**
     * @param $id
     * @param \Api\Http\Controllers\\Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        return KitRepository::update($id, $request);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return KitRepository::delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getConstructionsByKit($id)
    {
        return KitRepository::getConstructionsByKit($id);
    }
}
