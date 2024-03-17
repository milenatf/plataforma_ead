<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function index(Request $request)
    {
        return SupportResource::collection($this->repository->getSupports($request->all()));
    }

    public function mySupports(Request $request)
    {
        return SupportResource::collection($this->repository->getMySupports($request->all()));
    }

    public function store(StoreSupportRequest $request)
    {
        $support = $this->repository->createNewSupport($request->validated());
        return new SupportResource($support);
    }
}
