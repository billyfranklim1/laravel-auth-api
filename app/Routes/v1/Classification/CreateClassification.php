<?php

namespace App\Routes\v1\Classification;

/**
 * @OA\Tag(
 *     name="Classification",
 *     description="Classificações do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/classification",
 *      tags={"Classification"},
 *      operationId="createClassification",
 *      description="Criação de classificação.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Classification Create",
*                              title="Classification Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição da classificação.",
*                                  example="Limpa",
*                              ),
*                          ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Criação realizada com sucesso.",
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
class CreateClassification
{
};
