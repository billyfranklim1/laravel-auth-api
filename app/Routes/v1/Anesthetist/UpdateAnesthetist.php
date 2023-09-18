<?php

namespace App\Routes\v1\Anesthetist;

/**
 * @OA\Tag(
 *     name="Anesthetist",
 *     description="Anestesistas do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/anesthetist/{id}",
 *      tags={"Anesthetist"},
 *      operationId="updateAnesthetist",
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
 *                 schema="Anesthetist Update",
 *                 title="Anesthetist Update",
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
class UpdateAnesthetist
{
};
