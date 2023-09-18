<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\Patient\PatientResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Models\Webclin\MedicalRecord;
use App\Models\Webclin\Patient;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PatientRepository
{
    /**
     * @var Patient
     */
    private Patient $model;

    /**
     * @var MedicalRecord
     */
    private MedicalRecord $medicalRecord;

    /**
     * @param Patient $model
     * @param MedicalRecord $medicalRecord
     */
    public function __construct(Patient $model, MedicalRecord $medicalRecord)
    {
        $this->model = $model;
        $this->medicalRecord = $medicalRecord;
    }

    /**
     * @param array $params
     * @param $patientId
     * @return ModelChangeResource|GenericResponseResource
     */
    public function createOrUpdate(array $params, $patientId = null): ModelChangeResource|GenericResponseResource
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $params['name'] ?? null,
                'social_name' => $params['social_name'] ?? null,
                'mother_name' => $params['mother_name'] ?? null,
                'email' => $params['email'] ?? null,
                'sus' => $params['sus'] ?? null,
                'birthday' => $params['birthday'] ?? null,
                'rg' => $params['rg'] ?? null,
                'cpf' => $params['cpf'] ?? null,
                'gender' => $params['gender'] ?? null,
                'address' => $params['address'] ?? null,
                'number' => $params['number'] ?? null,
                'city' => $params['city'] ?? null,
                'uf' => $params['state'] ?? null,
                'zip' => $params['zip'] ?? null,
                'complement' => $params['complement'] ?? null,
                'neighborhood' => $params['neighborhood'] ?? null,
                'phone' => $params['phone'] ?? null,
                'cellphone' => $params['cellphone'] ?? null,
            ];

            if ($patientId) {
                $patient = $this->model->find($patientId);

                if (empty($patient)) return new GenericResponseResource(
                    'Paciente não encontrado',
                    Response::HTTP_NOT_FOUND
                );

                $patient->update($data);
            } else {
                $patient = $this->model->create($data);
            }

            $record = MedicalRecord::where('patient_id', $patient->id)
                ->where('unit_id', json_decode($params['unit'], true)['id'])->first();

            if (!isset($params['medical_record']) && empty($params['medical_record'])) {
                $recordNumber = MedicalRecord::where('unit_id', json_decode($params['unit'], true)['id'])->max('number');
                $recordNumber = $recordNumber + 1;
            } else $recordNumber = $params['medical_record'];

            $data = [
                'number' => $recordNumber,
                'patient_id' => $patient->id,
                'unit_id' => json_decode($params['unit'], true)['id'],
                'user_id' => json_decode($params['user'], true)['id'],
            ];

            if (!empty($record)) {
                $medicalRecord = $this->medicalRecord->find($recordNumber);
                $medicalRecord->update($data);
            } else {
                $this->medicalRecord->create($data);
            }
            DB::commit();
            return new ModelChangeResource($patient);
        } catch (\Throwable $th) {
            DB::rollBack();
            return new GenericResponseResource(
                'Erro ao cadastrar paciente: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param $id
     * @return PatientResource|GenericResponseResource
     */
    public function find($id): PatientResource|GenericResponseResource
    {
        $patient = $this->model->find($id);

        if (empty($patient)) return new GenericResponseResource(
            'Paciente não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new PatientResource($patient);
    }

    /**
     * @param array $params
     * @return AnonymousResourceCollection
     */
    public function list(array $params): AnonymousResourceCollection
    {
        $perPage = $params['per_page'] ?? 10;
        $page = $params['page'] ?? 1;

        $query = $this->model->query()->with('medicalRecords', function ($query) use ($params) {
            $query->where('unit_id', $params['unit_id'] ?? null);
        });

        if (isset($params['q']) && !empty($params['q'])) {
            $searchTerm = '%' . $params['q'] . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm);
                $q->where('cpf', 'like', $searchTerm);
                $q->where('email', 'like', $searchTerm);
            });
        }

        $query->orderBy('created_at', 'desc');

        return PatientResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $patient = $this->model->find($id);

        if (empty($patient)) return new GenericResponseResource(
            'Paciente não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $patient->delete();

        return new ModelChangeResource($patient);
    }
}
