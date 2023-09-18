<?php

namespace App\Routes\v1\Classification;

/**
 * @OA\Tag(
 *     name="Classification",
 *     description="Classificações do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/classification",
 *      tags={"Classification"},
 *      operationId="getClassifications",
 *      description="Obter lista de classificação.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de classificação obtida com sucesso.",
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
 *                          description="ID da classificação."
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string",
 *                          description="Descrição da classificação."
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

class ListClassification
{
};
