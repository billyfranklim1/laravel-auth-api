<?php

namespace App\Routes\v1\BloodComponent;
/**
 * @OA\Tag(
 *     name="BloodComponent",
 *     description="hemocomponentes do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/blood-component/{id}",
 *      tags={"BloodComponent"},
 *      operationId="updateBloodComponent",
 *      description="Atualizar informações de um anestesista específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do anestesista",
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
 *                 schema="Blood Component Update",
 *                 title="Blood Component Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Nova descrição do anestesista.",
 *                     example="Anesthetistoprofilaxia",
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
class UpdateBloodComponent
{
};
