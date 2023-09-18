<?php

namespace App\Routes\v1\Anesthetist;

/**
 * @OA\Tag(
 *     name="Anesthetist",
 *     description="Anestesistas do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/anesthetist",
 *      tags={"Anesthetist"},
 *      operationId="getAnesthetists",
 *      description="Obter lista de anestesistas.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de anestesistas obtida com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      type="object",
 *                      @OA\Property(
 *                          property="id",
 *                          format="int64",
 *                          type="integer",
 *                          description="ID do anestesista."
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string",
 *                          description="Descrição do anestesista."
 *                      ),
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="meta",
 *                  type="object",
 *                  description="Metadados adicionais."
 *              ),
 *              @OA\Property(
 *                  property="link",
 *                  type="object",
 *                  description="Links adicionais."
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

class ListAnesthetist
{
};
