<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenericResponseResource extends JsonResource
{
    protected $statusCode;

    /**
     * @param $resource
     * @param int $statusCode
     */
    public function __construct($resource, int $statusCode = 200)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
    }

    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => $this->resource,
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->statusCode);
    }
}
