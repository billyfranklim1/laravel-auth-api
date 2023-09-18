<?php

namespace App\Routes\v1\UnitType;

/**
 * @OA\Tag(
 *     name="UnitType",
 *     description="Tipos de Unidade do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/unit-type/{id}",
 *      tags={"UnitType"},
 *      operationId="getUnitType",
 *      description="Obter informações de um tipo de unidade específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do tipo de unidade",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Informações do tipo de unidade obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do tipo de unidade."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do tipo de unidade."
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

class GetUnitType
{
};
