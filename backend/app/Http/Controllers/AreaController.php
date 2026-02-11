<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    protected $service;

    public function __construct(AreaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->listarAreas());
    }

    public function store(Request $request)
    {
        $data = $this->service->registrarArea($request->all());
        return response()->json($data, 201);
    }
}