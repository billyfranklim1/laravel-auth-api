<?php

namespace App\Routes\v1\BloodComponent;

/**
 * @OA\Tag(
 *     name="BloodComponent",
 *     description="Hemocomponentes do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/blood-component/{id}",
 *      tags={"BloodComponent"},
 *      operationId="deleteBloodComponent",
 *      description="Excluir um hemocomponentes específico.",
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
 *          description="Hemocomponentes excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Hemocomponentes não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteBloodComponent
{
};
