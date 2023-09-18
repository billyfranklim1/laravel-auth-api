<?php

namespace App\Routes\v1\Size;

/**
 * @OA\Tag(
 *     name="Size",
 *     description="Portes do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/size/{id}",
 *      tags={"Size"},
 *      operationId="deleteSize",
 *      description="Excluir um porte específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do porte",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Porte excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Porte não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteSize
{
};
