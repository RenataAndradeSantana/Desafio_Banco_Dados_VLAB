<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Nome da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor é o nome da sua aplicação, que será utilizado quando o
    | framework precisar colocar o nome da aplicação em uma notificação ou
    | outros elementos da interface onde o nome da aplicação precisa ser exibido.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" no qual a sua aplicação está sendo
    | executada. Isso pode determinar como você prefere configurar diversos
    | serviços que a aplicação utiliza. Defina isso no seu arquivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Depuração da Aplicação
    |--------------------------------------------------------------------------
    |
    | Quando a sua aplicação está no modo de depuração, mensagens de erro detalhadas
    | com rastreamentos de pilha serão exibidas em cada erro que ocorrer dentro
    | da sua aplicação. Se desativado, uma página de erro genérica será mostrada.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL da Aplicação
    |--------------------------------------------------------------------------
    |
    | Esta URL é utilizada pelo console para gerar URLs corretamente ao usar
    | a ferramenta de linha de comando Artisan. Você deve definir isso como
    | o diretório raiz da aplicação para que esteja disponível dentro dos comandos Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuso Horário da Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão para sua aplicação, que
    | será usado pelas funções de data e hora do PHP. O fuso horário é definido
    | como "UTC" por padrão, pois é adequado para a maioria dos casos de uso.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Configuração de Localidade da Aplicação
    |--------------------------------------------------------------------------
    |
    | A localidade da aplicação determina a localidade padrão que será usada
    | pelos métodos de tradução / localização do Laravel. Esta opção pode ser
    | definida para qualquer localidade para a qual você planeja ter strings de tradução.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Esta chave é utilizada pelos serviços de criptografia do Laravel e deve ser
    | definida como uma string aleatória de 32 caracteres para garantir que todos os valores
    | criptografados sejam seguros. Você deve fazer isso antes de implantar a aplicação.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver de Modo de Manutenção
    |--------------------------------------------------------------------------
    |
    | Estas opções de configuração determinam o driver usado para determinar e
    | gerenciar o status do "modo de manutenção" do Laravel. O driver "cache"
    | permitirá que o modo de manutenção seja controlado em várias máquinas.
    |
    | Drivers suportados: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
