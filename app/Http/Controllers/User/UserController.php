<?php

namespace Api\Http\Controllers\User;

use Illuminate\Http\Request;
use Api\Http\Controllers\Controller;
use Facades\Api\Repositories\UserRepository;

/**
 * Class UserController
 * @package Api\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('JWT.auth')->only('update', 'destroy', 'getUserByConstruction');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return UserRepository::getAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return UserRepository::read($id);
    }

    /**
     * @param \Api\Http\Controllers\\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return UserRepository::create($request);
    }

    /**
     * @param $id
     * @param \Api\Http\Controllers\\Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        return UserRepository::update($id, $request);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return UserRepository::delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserByConstruction($id)
    {
        return UserRepository::getUserByConstruction($id);
    }
}
