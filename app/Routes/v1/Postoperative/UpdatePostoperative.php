<?php

namespace App\Routes\v1\Postoperative;
/**
 * @OA\Tag(
 *     name="Postoperative",
 *     description="Pós Operatórios do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/postoperative/{id}",
 *      tags={"Postoperative"},
 *      operationId="updatePostoperative",
 *      description="Atualizar informações de um pós operatório específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do pós operatório",
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
 *                 schema="Postoperative Update",
 *                 title="Postoperative Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Nova descrição do pós operatório.",
 *                     example="Postoperativeoprofilaxia",
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
class UpdatePostoperative
{
};
