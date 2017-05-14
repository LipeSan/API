<?php

namespace Api\Repositories\Contracts;

interface ConstructionRepositoryContract
{
    public function getAll();
    public function getPagination($limit);
    public function read($id);
    public function create($request);
    public function update($id, $request);
    public function delete($id);
}