<?php

namespace App\Routes\v1\Antibiotic;

/**
 * @OA\Tag(
 *     name="Antibiotic",
 *     description="Antibióticos do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/antibiotic/{id}",
 *      tags={"Antibiotic"},
 *      operationId="getAntibiotic",
 *      description="Obter informações de um antibiótico específico.",
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
 *          description="Informações do antibiótico obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do antibiótico."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do antibiótico."
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

class GetAntibiotic
{
};
