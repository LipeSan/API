<?php

namespace Api\Repositories\Contracts;

interface KitRepositoryContract
{
    public function getAll();
    public function read($id);
    public function create($request);
    public function update($id, $request);
    public function delete($id);
}