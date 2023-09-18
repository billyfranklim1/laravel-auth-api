<?php

namespace App\Routes\v1\BloodType;

/**
 * @OA\Tag(
 *     name="BloodType",
 *     description="Tipos sanguíneo do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/blood-type/{id}",
 *      tags={"BloodType"},
 *      operationId="deleteBloodType",
 *      description="Excluir um tipo sanguíneo específica.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do tipo sanguíneo",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Tipo sanguíneo excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Tipo sanguíneo não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteBloodType
{
};
