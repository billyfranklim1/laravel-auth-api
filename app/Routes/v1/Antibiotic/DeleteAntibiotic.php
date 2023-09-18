<?php

namespace App\Routes\v1\Antibiotic;

/**
 * @OA\Tag(
 *     name="Antibiotic",
 *     description="Antibióticos do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/antibiotic/{id}",
 *      tags={"Antibiotic"},
 *      operationId="deleteAntibiotic",
 *      description="Excluir um antibiótico específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do antibiótico",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Antibiótico excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Antibiótico não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteAntibiotic
{
};
