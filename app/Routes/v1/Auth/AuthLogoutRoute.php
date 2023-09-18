<?php

namespace App\Routes\v1\Auth;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *      name="Auth",
 *      description="Autenticação dos diversos tipos de usuários."
 * ),
 * @OA\Get(
 *      path="/api/auth/logout",
 *      tags={"Auth"},
 *      operationId="getLogout",
 *      description="Logout de usuário com o token de autorização.",
 *      security={{"bearerAuth":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Deslogado com sucesso.",
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
class AuthLogoutRoute
{
};
