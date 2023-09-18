<?php

namespace App\Routes\v1\UnitType;

/**
 * @OA\Tag(
 *     name="UnitType",
 *     description="Tipos de Unidade do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/unit-type/{id}",
 *      tags={"UnitType"},
 *      operationId="deleteUnitType",
 *      description="Excluir um tipo de unidade específico.",
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
 *          description="Anestesista excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Anestesista não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteUnitType
{
};
