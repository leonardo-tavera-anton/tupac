<?php

namespace App\Repositories;

use App\Models\Area;

class AreaRepository
{
    public function all()
    {
        return Area::with('procedimientos')->get();
    }

    public function create(array $data)
    {
        return Area::create($data);
    }

    public function find($id)
    {
        return Area::findOrFail($id);
    }
}