<?php

namespace App\Routes\v1\BloodComponent;

/**
 * @OA\Tag(
 *     name="BloodComponent",
 *     description="Hemocomponentes do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/blood-component/{id}",
 *      tags={"BloodComponent"},
 *      operationId="getBloodComponent",
 *      description="Obter informações de um hemocomponentes específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do hemocomponentes",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Informações do hemocomponentes obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do hemocomponentes."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do hemocomponentes."
 *                  ),
 *              ),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class GetBloodComponent
{
};
