<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Throwable;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API CORE - COMPANY",
 *      description="Api de acesso ao sistema CORE",
 *      @OA\Contact(
 *          email="billyfranklim@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *        url="http://api.core.local:9192",
 *        description="Ambiente de desenvolvimento local"
 *  ),
 * @OA\Server(
 *        url="https://auth.billy.dev.br",
 *        description="Ambiente de desenvolvimento online"
 *  ),
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *  ),
 *
 * @OA\PathItem(
 *      path="/app"
 *  ),
 * */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Throwable $exception
     * @return JsonResponse
     */
    protected function internalServerErrorResponse(Throwable $exception): JsonResponse
    {
        return response()->json(['data' => [
            'message' => $exception->getMessage()
        ]])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
