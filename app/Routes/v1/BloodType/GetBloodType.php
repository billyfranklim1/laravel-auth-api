<?php

namespace App\Routes\v1\BloodType;

/**
 * @OA\Tag(
 *     name="BloodType",
 *     description="Tipos sanguíneo do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/blood-type/{id}",
 *      tags={"BloodType"},
 *      operationId="getBloodType",
 *      description="Obter informações de um tipo sanguíneo específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do tipo sanguíneo",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Informações do tipo sanguíneo obtidos com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do tipo sanguíneo."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do tipo sanguíneo."
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

class GetBloodType
{
};
