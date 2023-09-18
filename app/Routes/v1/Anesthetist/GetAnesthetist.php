<?php

namespace App\Routes\v1\Anesthetist;

/**
 * @OA\Tag(
 *     name="Anesthetist",
 *     description="Anestesistas do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/anesthetist/{id}",
 *      tags={"Anesthetist"},
 *      operationId="getAnesthetist",
 *      description="Obter informações de um anestesista específico.",
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
 *          description="Informações do anestesista obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do anestesista."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do anestesista."
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

class GetAnesthetist
{
};
