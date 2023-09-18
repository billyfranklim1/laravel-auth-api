<?php

namespace App\Routes\v1\Size;

/**
 * @OA\Tag(
 *     name="Size",
 *     description="Tamanhos/Portes do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/size/{id}",
 *      tags={"Size"},
 *      operationId="getSize",
 *      description="Obter informações de um porte específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do porte.",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64",
 *          ),
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Informações do porte obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do porte.",
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do porte.",
 *                  ),
 *                  @OA\Property(
 *                      property="time",
 *                      type="string",
 *                      description="Tempo no formato 00:00.",
 *                  ),
 *              ),
 *          ),
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

class GetSize
{
};
