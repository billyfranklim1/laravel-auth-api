<?php

namespace App\Routes\v1\Antibiotic;

/**
 * @OA\Tag(
 *     name="Antibiotic",
 *     description="Antibióticos do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/antibiotic",
 *      tags={"Antibiotic"},
 *      operationId="createAntibiotic",
 *      description="Criação de antibiótico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Antibiotic Create",
*                              title="Antibiotic Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do antibiótico.",
*                                  example="Antibioticoprofilaxia",
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
class CreateAntibiotic
{
};
