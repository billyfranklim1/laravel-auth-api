<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\MedicalRecord\MedicalRecordResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\MedicalRecord;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MedicalRecordRepository
{
    /**
     * @var MedicalRecord
     */
    private MedicalRecord $model;

    /**
     * @param MedicalRecord $model
     */
    public function __construct(MedicalRecord $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $medicalRecordId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $medicalRecordId = null): ModelChangeResource
    {
        $recordFind = MedicalRecord::find($medicalRecordId);
        $record = MedicalRecord::where('patient_id', $recordFind->patient_id)
            ->where('unit_id', json_decode($params['unit'], true)['id'])->first();

        if (!isset($params['number']) && empty($params['number'])) {
            $recordNumber = MedicalRecord::where('unit_id', json_decode($params['unit'], true)['id'])->max('number');
            $recordNumber = $recordNumber + 1;
        } else $recordNumber = $params['number'];

        $data = [
            'number' => $params['number'] ?? $recordNumber,
            'patient_id' => $recordFind->patient_id,
            'unit_id' => json_decode($params['unit'], true)['id'],
            'user_id' => json_decode($params['user'], true)['id'],
        ];

        if (!empty($record)) {
            $medicalRecord = $this->model->find($record->id);
            $medicalRecord->update($data);
        } else {
            $medicalRecord = $this->model->create($data);
        }


        return new ModelChangeResource($medicalRecord);
    }

    /**
     * @param $id
     * @return MedicalRecordResource|GenericResponseResource
     */
    public function find($id): MedicalRecordResource|GenericResponseResource
    {
        $medicalRecord = $this->model->find($id);

        if (empty($medicalRecord)) return new GenericResponseResource(
            'Prontuáro não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new MedicalRecordResource($medicalRecord);
    }

    /**
     * @param array $params
     * @return AnonymousResourceCollection
     */
    public function list(array $params): AnonymousResourceCollection
    {
        $perPage = $params['per_page'] ?? 10;
        $page = $params['page'] ?? 1;

        $query = $this->model->query()->with('patient');

        if (isset($params['q']) && !empty($params['q'])) {
            $searchTerm = '%' . $params['q'] . '%';
            $query->where(function ($q) use ($searchTerm, $params) {
                $q->where('number', 'like', $searchTerm)
                ->where('unit_id', $params['unit_id'] ?? null);
            });
            $query->orWhereHas('patient', function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm);
                $q->orWhere('sus', 'like', $searchTerm);
            });
        }

        $query->selectRaw('*, "' . ($params['unit_id'] ?? null) . '" as params_unit_id');

        $query->orderBy('created_at', 'desc');

        return MedicalRecordResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }
}
