<?php

namespace App\Routes\v1\System;

/**
 * @OA\Tag(
 *     name="System",
 *     description="System of the coorporation.",
 * ),
 * @OA\Post(
 *      path="/api/system",
 *      tags={"System"},
 *      operationId="createSystem",
 *      description="Creation of the system.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 schema="System Create",
 *                 title="System Create",
 *                 required={"description"},
 *                 @OA\Property(
 *                     property="description",
 *                     format="string",
 *                     type="string",
 *                     description="System description.",
 *                     example="API CORE",
 *                 )
 *             ),
 *         ),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="System creation succefull.",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Invalid Token.",
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error.",
 *      ),
 *  )
 */

class CreateSystem
{
};
