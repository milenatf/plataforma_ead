<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Repositories\Courserepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $repository;

    public function __construct(Courserepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function index()
    {
        return CourseResource::collection($this->repository->getAllCourses());
    }

    public function show($id)
    {
        return new CourseResource($this->repository->getCourse($id));
    }
}
