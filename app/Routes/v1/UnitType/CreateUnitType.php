<?php

namespace App\Routes\v1\UnitType;

/**
 * @OA\Tag(
 *     name="UnitType",
 *     description="Tipos de Unidade do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/unit-type",
 *      tags={"UnitType"},
 *      operationId="createUnitType",
 *      description="Criação de Tipo de Unidade .",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="UnitType Create",
*                              title="UnitType Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do tipo de unidade.",
*                                  example="UnitTypeoprofilaxia",
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
class CreateUnitType
{
};
