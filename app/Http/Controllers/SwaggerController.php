<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API de Monitoramento Financeiro",
 *     version="1.0",
 *     description="Documentação da API do sistema de monitoramento financeiro."
 * )
 * 
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor principal"
 * )
 */
class SwaggerController
{
    // Controlador apenas para centralizar anotações Swagger
}
