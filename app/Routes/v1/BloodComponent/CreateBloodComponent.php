<?php

namespace App\Routes\v1\BloodComponent;

/**
 * @OA\Tag(
 *     name="BloodComponent",
 *     description="Hemocomponentes do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/blood-component",
 *      tags={"BloodComponent"},
 *      operationId="createBloodComponent",
 *      description="Criação de hemocomponentes.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Blood Component Create",
*                              title="Blood Component Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do hemocomponentes.",
*                                  example="Anesthetistoprofilaxia",
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
class CreateBloodComponent
{
};
