<?php

namespace App\Routes\v1\Size;

/**
 * @OA\Tag(
 *     name="Size",
 *     description="Tamanhos/Portes do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/size/{id}",
 *      tags={"Size"},
 *      operationId="updateSize",
 *      description="Atualizar informações de um porte específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do porte",
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
 *                 schema="Porte Update",
 *                 title="Porte Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Descrição do porte.",
 *                     example="Grande",
 *                 ),
 *                 @OA\Property(
 *                     property="time",
 *                     format="time",
 *                     type="string",
 *                     description="Tempo no formato HH:MM",
 *                     example="15:45",
 *                 ),
 *             ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Atualização de porte realizada com sucesso.",
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

class UpdateSize
{
};
