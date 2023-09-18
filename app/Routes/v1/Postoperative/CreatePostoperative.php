<?php

namespace App\Routes\v1\Postoperative;

/**
 * @OA\Tag(
 *     name="Postoperative",
 *     description="Pós Operatórios do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/postoperative",
 *      tags={"Postoperative"},
 *      operationId="createPostoperative",
 *      description="Criação de pós operatório.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Postoperative Create",
*                              title="Postoperative Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do pós operatório.",
*                                  example="Postoperativeoprofilaxia",
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
class CreatePostoperative
{
};
