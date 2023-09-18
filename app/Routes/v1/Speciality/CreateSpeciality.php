<?php

namespace App\Routes\v1\Speciality;

/**
 * @OA\Tag(
 *     name="Speciality",
 *     description="Especialidades do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/speciality",
 *      tags={"Speciality"},
 *      operationId="createSpeciality",
 *      description="Criação de especialidade.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
*                          @OA\Schema(
*                              schema="Speciality Create",
*                              title="Speciality Create",
*		                  		required={"description"},
*                              @OA\Property(
*                                  property="description",
*                                  format="string",
*                                  type="string",
*                                  description="Descrição do especialidade.",
*                                  example="Specialityoprofilaxia",
*                              ),
*                          ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Criação realizada com sucesso.",
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
class CreateSpeciality
{
};
