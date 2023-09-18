<?php

namespace App\Routes\v1\Postoperative;

/**
 * @OA\Tag(
 *     name="Postoperative",
 *     description="Pós Operatórios do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/postoperative/{id}",
 *      tags={"Postoperative"},
 *      operationId="getPostoperative",
 *      description="Obter informações de um pós operatório específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do pós operatório",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Informações do pós operatório obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do pós operatório."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do pós operatório."
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

class GetPostoperative
{
};
