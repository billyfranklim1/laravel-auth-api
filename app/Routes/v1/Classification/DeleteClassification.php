<?php

namespace App\Routes\v1\Classification;

/**
 * @OA\Tag(
 *     name="Classification",
 *     description="Classificações do sistema.",
 * ),
 * @OA\Delete(
 *      path="/api/classification/{id}",
 *      tags={"Classification"},
 *      operationId="deleteClassification",
 *      description="Excluir uma classificação específica.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID da classificação",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Classificação excluída com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Classificação não encontrada.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class DeleteClassification
{
};
