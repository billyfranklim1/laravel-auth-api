<?php

namespace App\Routes\v1\BloodType;

/**
 * @OA\Tag(
 *     name="BloodType",
 *     description="Tipos sanguíneo do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/blood-type",
 *      tags={"BloodType"},
 *      operationId="createBloodType",
 *      description="Criação de tipo sanguíneo.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Blood Type Create",
*                              title="Blood Type Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do tipo sanguíneo.",
*                                  example="O-",
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
class CreateBloodType
{
};
