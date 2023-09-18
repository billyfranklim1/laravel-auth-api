<?php

namespace App\Http\Controllers\Webclin\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Patient\RegisterPatientRequest;
use App\Http\Requests\Webclin\Patient\UpdatePatientRequest;
use App\Http\Resources\Webclin\Patient\PatientResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\PatientRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PatientController extends Controller
{
    /**
     * @var PatientRepository
     */
    private PatientRepository $patientRepository;

    /**
     * @param PatientRepository $patientRepository
     */
    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->patientRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterPatientRequest $request
     * @return GenericResponseResource|ModelChangeResource|JsonResponse
     */
    public function store(RegisterPatientRequest $request): GenericResponseResource|ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->patientRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return PatientResource|JsonResponse|GenericResponseResource
     */
    public function show($id): PatientResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->patientRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdatePatientRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdatePatientRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->patientRepository->createOrUpdate($data, $id);
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
            return $this->patientRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
