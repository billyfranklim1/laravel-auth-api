<?php

namespace App\Routes\v1\BloodComponent;

/**
 * @OA\Tag(
 *     name="BloodComponent",
 *     description="Hemocomponentes do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/blood-component",
 *      tags={"BloodComponent"},
 *      operationId="getBloodComponents",
 *      description="Obter lista de hemocomponentess.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Lista de hemocomponentess obtida com sucesso.",
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
 *                          description="ID do hemocomponentes."
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string",
 *                          description="Descrição do hemocomponentes."
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

class ListBloodComponent
{
};
