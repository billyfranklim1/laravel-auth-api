<?php

namespace App\Routes\v1\Antibiotic;

/**
 * @OA\Tag(
 *     name="Antibiotic",
 *     description="Antibióticos do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/antibiotic",
 *      tags={"Antibiotic"},
 *      operationId="getAntibiotics",
 *      description="Obter lista de antibióticos.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de antibióticos obtida com sucesso.",
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
 *                          description="ID do antibiótico."
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string",
 *                          description="Descrição do antibiótico."
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

class ListAntibiotic
{
};
