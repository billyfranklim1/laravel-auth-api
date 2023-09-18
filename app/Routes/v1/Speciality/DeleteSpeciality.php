<?php

namespace App\Routes\v1\Speciality;

/**
 * @OA\Tag(
 *     name="Speciality",
 *     description="Especialidades do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/speciality/{id}",
 *      tags={"Speciality"},
 *      operationId="deleteSpeciality",
 *      description="Excluir um especialidade específico.",
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
 *          description="Especialidade excluído com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Especialidade não encontrado.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteSpeciality
{
};
