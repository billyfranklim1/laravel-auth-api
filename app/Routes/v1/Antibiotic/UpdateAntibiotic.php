<?php

namespace App\Routes\v1\Antibiotic;
/**
 * @OA\Tag(
 *     name="Antibiotic",
 *     description="Antibióticos do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/antibiotic/{id}",
 *      tags={"Antibiotic"},
 *      operationId="updateAntibiotic",
 *      description="Atualizar informações de um antibiótico específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do antibiótico",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 schema="Antibiotic Update",
 *                 title="Antibiotic Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Nova descrição do antibiótico.",
 *                     example="Antibioticoprofilaxia",
 *                 ),
 *             ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Atualização realizada com sucesso.",
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
class UpdateAntibiotic
{
};
