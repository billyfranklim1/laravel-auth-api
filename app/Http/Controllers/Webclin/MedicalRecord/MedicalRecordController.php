<?php

namespace App\Http\Controllers\Webclin\MedicalRecord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\MedicalRecord\RegisterMedicalRecordRequest;
use App\Http\Requests\Webclin\MedicalRecord\UpdateMedicalRecordRequest;
use App\Http\Resources\Webclin\MedicalRecord\MedicalRecordResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\MedicalRecordRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MedicalRecordController extends Controller
{
    /**
     * @var MedicalRecordRepository
     */
    private MedicalRecordRepository $medicalRecordRepository;

    /**
     * @param MedicalRecordRepository $medicalRecordRepository
     */
    public function __construct(MedicalRecordRepository $medicalRecordRepository)
    {
        $this->medicalRecordRepository = $medicalRecordRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->medicalRecordRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return MedicalRecordResource|JsonResponse|GenericResponseResource
     */
    public function show($id): MedicalRecordResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->medicalRecordRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateMedicalRecordRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateMedicalRecordRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->medicalRecordRepository->createOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
