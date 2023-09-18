<?php

namespace App\Http\Controllers\Webclin\Postoperative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Postoperative\RegisterPostoperativeRequest;
use App\Http\Requests\Webclin\Postoperative\UpdatePostoperativeRequest;
use App\Http\Resources\Webclin\Postoperative\PostoperativeResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\PostoperativeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostoperativeController extends Controller
{
    /**
     * @var PostoperativeRepository
     */
    private PostoperativeRepository $postoperativeRepository;

    /**
     * @param PostoperativeRepository $postoperativeRepository
     */
    public function __construct(PostoperativeRepository $postoperativeRepository)
    {
        $this->postoperativeRepository = $postoperativeRepository;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->postoperativeRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterPostoperativeRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterPostoperativeRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->postoperativeRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return PostoperativeResource|JsonResponse|GenericResponseResource
     */
    public function show($id): PostoperativeResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->postoperativeRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdatePostoperativeRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdatePostoperativeRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->postoperativeRepository->createOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return GenericResponseResource|ModelChangeResource|JsonResponse
     */
    public function destroy($id): GenericResponseResource|ModelChangeResource|JsonResponse
    {
        try {
            return $this->postoperativeRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
