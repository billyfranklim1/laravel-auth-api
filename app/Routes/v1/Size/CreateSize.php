<?php

namespace App\Routes\v1\Size;

/**
 * @OA\Tag(
 *     name="Size",
 *     description="Tamanhos/Portes do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/size",
 *      tags={"Size"},
 *      operationId="createSize",
 *      description="Criação de porte.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 schema="Porte Create",
 *                 title="Porte Create",
 *                 required={"description", "time"},
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Descrição do porte.",
 *                     example="Pequeno",
 *                 ),
 *                 @OA\Property(
 *                     property="time",
 *                     format="time",
 *                     type="string",
 *                     description="Tempo no formato HH:MM",
 *                     example="10:30",
 *                 ),
 *             ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Criação de porte realizada com sucesso.",
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

class CreateSize
{
};
