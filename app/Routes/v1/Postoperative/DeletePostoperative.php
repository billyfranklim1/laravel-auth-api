<?php

namespace App\Routes\v1\Postoperative;

/**
 * @OA\Tag(
 *     name="Postoperative",
 *     description="Pós Operatórios do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/postoperative/{id}",
 *      tags={"Postoperative"},
 *      operationId="deletePostoperative",
 *      description="Excluir um pós operatórios específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do pós operatórios",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Pós Operatórios excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Pós Operatórios não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeletePostoperative
{
};
