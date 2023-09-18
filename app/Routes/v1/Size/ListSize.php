<?php

namespace App\Routes\v1\Size;

/**
 * @OA\Tag(
 *     name="Size",
 *     description="Tamanhos/Portes do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/size",
 *      tags={"Size"},
 *      operationId="listSizes",
 *      description="Listagem de portes.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Listagem de portes obtida com sucesso.",
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
 *                          description="ID do porte.",
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string",
 *                          description="Descrição do porte.",
 *                      ),
 *                      @OA\Property(
 *                          property="time",
 *                          type="string",
 *                          description="Tempo no formato 00:00.",
 *                      ),
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="meta",
 *                  type="object",
 *                  description="Metadados adicionais.",
 *              ),
 *              @OA\Property(
 *                  property="link",
 *                  type="object",
 *                  description="Links adicionais.",
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

class ListSize
{
};
