<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ModelChangeResource extends JsonResource
{
    protected $statusCode;

    /**
     * @param $request
     * @return array|Arrayable|JsonResponse|\JsonSerializable
     */
    public function toArray($request): array|Arrayable|JsonResponse|\JsonSerializable
    {
        $this->statusCode = Response::HTTP_OK;
        if ($this->isDeleted()) {
            $message = 'Deleção realizada com sucesso';
        } else {
            if ($this->wasRecentlyCreated) {
                $message = 'Criação realizada com sucesso';
            } elseif ($this->exists()) {
                if ($this->wasChanged()) {
                    $message = 'Atualização realizada com sucesso';
                } else {
                    $message = 'Sem alteração';
                }
            } else {
                $message = 'Erro ao executar função';
                $this->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            }
        }

        return [
            'message' => $message,
        ];
    }

    /**
     * @return bool
     */
    private function isDeleted(): bool
    {
        return $this->resource->deleted_at !== null;
    }

    /**
     * @param $request
     * @param $response
     * @return void
     */
    public function withResponse($request, $response): void
    {
        $response->setStatusCode($this->statusCode);
    }
}
