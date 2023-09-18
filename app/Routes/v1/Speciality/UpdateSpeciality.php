<?php

namespace App\Routes\v1\Speciality;
/**
 * @OA\Tag(
 *     name="Speciality",
 *     description="Especialidades do sistema.",
 * ),
 * @OA\Put(
 *      path="/api/speciality/{id}",
 *      tags={"Speciality"},
 *      operationId="updateSpeciality",
 *      description="Atualizar informações de um especialidade específico.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID do especialidade",
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
 *                 schema="Speciality Update",
 *                 title="Speciality Update",
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="Nova descrição do especialidade.",
 *                     example="Specialityoprofilaxia",
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
class UpdateSpeciality
{
};
