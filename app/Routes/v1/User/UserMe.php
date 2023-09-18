<?php

namespace App\Routes\v1\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User",
 *     description="Usuários do sistema.",
 * ),
 * @OA\Get(
 *      path="/api/user/me",
 *      tags={"User"},
 *      operationId="getUserMe",
 *      description="Retorna os dados do usuário logado.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Usuário logado.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Token inválido.",
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad request.",
 *      ),
 *  )
 */
class UserMe
{
};
