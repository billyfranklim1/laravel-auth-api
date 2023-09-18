<?php

namespace App\Routes\v1\Auth;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Autenticação dos diversos tipos de usuários."
 * ),
 * @OA\Post(
 *     path="/api/auth/login",
 *     tags={"Auth"},
 *     operationId="postLogin",
 *     description="Login de usuário com username e senha.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"email", "password", "system"},
 *                 @OA\Property(
 *                     property="email",
 *                     format="string",
 *                     type="string",
 *                     description="E-mail do usuário.",
 *                     example="example@mail.com",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     format="string",
 *                     type="string",
 *                     description="Senha do usuário.",
 *                     example="123456",
 *                 ),
 *                 @OA\Property(
 *                     property="system",
 *                     format="number",
 *                     type="number",
 *                     description="Tipo de sistema que o usuário está acessando.",
 *                     example="1",
 *                 ),
 *             )
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Retorna os dados do token do usuário autenticado.",
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request.",
 *     ),
 *)
 */
class AuthLoginRoute
{
};
