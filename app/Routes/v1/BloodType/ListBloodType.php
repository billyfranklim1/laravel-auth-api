<?php

namespace App\Routes\v1\BloodType;

/**
 * @OA\Tag(
 *     name="BloodType",
 *     description="Tipos sanguíneo do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/blood-type",
 *      tags={"BloodType"},
 *      operationId="getBloodTypes",
 *      description="Obter lista de tipo sanguíneo.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de tipo sanguíneo obtido com sucesso.",
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
 *                          description="ID do tipo sanguíneo."
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string",
 *                          description="Descrição do tipo sanguíneo."
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

class ListBloodType
{
};
