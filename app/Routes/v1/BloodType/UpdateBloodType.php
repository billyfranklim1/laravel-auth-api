<?php

namespace App\Routes\v1\BloodType;

/**
 * @OA\Tag(
 *     name="BloodType",
 *     description="Tipos sanguíneo do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/blood-type/{id}",
 *      tags={"BloodType"},
 *      operationId="updateBloodType",
 *      description="Atualizar informações de um tipo sanguíneo específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do tipo sanguíneo",
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
 *                 schema="Blood Type Update",
 *                 title="Blood Type Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Nova descrição do tipo sanguíneo.",
 *                     example="Limpa",
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
class UpdateBloodType
{
};
