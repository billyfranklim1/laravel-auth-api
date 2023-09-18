<?php

namespace App\Routes\v1\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User",
 *     description="Usuários do sistema.",
 * ),
 * @OA\Post(
 *      path="/api/user",
 *      tags={"User"},
 *      operationId="createUser",
 *      description="Criação de usuário.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"password", "system"},
 *                 @OA\Property(
 *                     property="user",
 *                     type="object",
 *                     format="object",
 *                     oneOf={
 *                          @OA\Schema(
 *                              schema="User Create",
 *                              title="User Create",
*		                  		required={"email"},
 *                              @OA\Property(
 *                                  property="name",
 *                                  format="string",
 *                                  type="string",
 *                                  description="Nome do usuário.",
 *                                  example="Teste da Silva",
 *                              ),
 *                              @OA\Property(
 *                                  property="email",
 *                                  format="string",
 *                                  type="string",
 *                                  description="E-mail do usuário.",
 *                                  example="example@mail.com",
 *                              ),
 *                              @OA\Property(
 *                                  property="password",
 *                                  format="string",
 *                                  type="string",
 *                                  description="Senha do usuário.",
 *                                  example="example@mail.com",
 *                              ),
 *                              @OA\Property(
 *                                  property="password_confirmation",
 *                                  format="string",
 *                                  type="string",
 *                                  description="Confirmação de Senha.",
 *                                  example="example@mail.com",
 *                              ),
 *                          ),
 *                      },
 *                 ),
 *                 @OA\Property(
 *                     property="permissions",
 *                     format="array",
 *                     type="array",
 *                     @OA\Items(), example={"Ler Emails", "Criar Usuários"}, description="Permissões do usuário",
 *                 ),
 *                 @OA\Property(
 *                     property="roles",
 *                     format="array",
 *                     type="array",
 *                     @OA\Items(), example={"Administrador", "Coordenador"}, description="Funções do usuário",
 *                 ),
 *                 @OA\Property(
 *                     property="systems",
 *                     format="array",
 *                     type="array",
 *                     @OA\Items(), example={1, 2}, description="Systems ID",
 *                 ),
 *             )
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
class CreateUser
{
};
