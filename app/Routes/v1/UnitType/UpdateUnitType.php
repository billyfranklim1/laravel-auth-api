<?php

namespace App\Routes\v1\UnitType;

/**
 * @OA\Tag(
 *     name="UnitType",
 *     description="Tipos de Unidade do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/unit-type/{id}",
 *      tags={"UnitType"},
 *      operationId="updateUnitType",
 *      description="Atualizar informações de um tipo de unidade específico.",
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
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 schema="UnitType Update",
 *                 title="UnitType Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Nova descrição do tipo de unidade.",
 *                     example="UnitTypeoprofilaxia",
 *                 ),
 *             ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Atualização realizada com sucesso.",
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
class UpdateUnitType
{
};
