<?php

namespace App\Routes\v1\Anesthetist;

/**
 * @OA\Tag(
 *     name="Anesthetist",
 *     description="Anestesistas do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/anesthetist/{id}",
 *      tags={"Anesthetist"},
 *      operationId="deleteAnesthetist",
 *      description="Excluir um anestesista específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do anestesista",
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

class DeleteAnesthetist
{
};
