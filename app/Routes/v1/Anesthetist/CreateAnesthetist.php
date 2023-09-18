<?php

namespace App\Routes\v1\Anesthetist;

/**
 * @OA\Tag(
 *     name="Anesthetist",
 *     description="Anestesistas do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/anesthetist",
 *      tags={"Anesthetist"},
 *      operationId="createAnesthetist",
 *      description="Criação de anestesista.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Anesthetist Create",
*                              title="Anesthetist Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do anestesista.",
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
class CreateAnesthetist
{
};
