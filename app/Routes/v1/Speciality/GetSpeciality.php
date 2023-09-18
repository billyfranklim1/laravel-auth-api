<?php

namespace App\Routes\v1\Speciality;

/**
 * @OA\Tag(
 *     name="Speciality",
 *     description="Especialidades do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/speciality/{id}",
 *      tags={"Speciality"},
 *      operationId="getSpeciality",
 *      description="Obter informações de um especialidade específico.",
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
 *      @OA\Response(
 *          response=200,
 *          description="Informações do especialidade obtidas com sucesso.",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      format="int64",
 *                      type="integer",
 *                      description="ID do especialidade."
 *                  ),
 *                  @OA\Property(
 *                      property="description",
 *                      type="string",
 *                      description="Descrição do especialidade."
 *                  ),
 *              ),
 *          ),
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

class GetSpeciality
{
};
