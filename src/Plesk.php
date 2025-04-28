<?php

declare( strict_types = 1 );

namespace Ocolin\PleskApi;

use Exception;
use Ocolin\EasySwagger\Swagger;
use Ocolin\Env\EasyEnv;

class Plesk
{
    private Swagger $swagger;

/*
----------------------------------------------------------------------------- */

    /**
     * @param Swagger|null $swagger
     * @param string|null $host
     * @param string|null $base_uri
     * @param string|null $api_key
     * @param string|null $api_file
     * @param bool $local
     * @throws Exception
     */
    public function __construct(
        ?Swagger $swagger  = null,
         ?string $host     = null,
         ?string $base_uri = null,
         ?string $api_key  = null,
         ?string $api_file = null,
            bool $local    = false
    )
    {
        if( $local === true ) {
            EasyEnv::loadEnv(path: __DIR__ . '/../.env');
        }
        $host     = $host     ?? $_ENV['PLESK_HOST'];
        $base_uri = $base_uri ?? $_ENV['PLESK_BASE_URI'];
        $api_key  = $api_key  ?? $_ENV['PLESK_TOKEN'];
        $api_file = $api_file ?? __DIR__ . '/api.v2.json';

        $this->swagger = $swagger ?? new Swagger(
                host: $host,
            api_file: $api_file,
            base_uri: $base_uri,
               token: $api_key,
          token_name: 'X-API-Key'
        );

    }



/*
----------------------------------------------------------------------------- */

    public function path(
        string $path,
        string $method = 'get',
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
              path: $path,
            method: $method,
              data: $data
        );
    }



/*
----------------------------------------------------------------------------- */

    public function get(
        string $path,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $path,
            data: $data
        );
    }



/*
----------------------------------------------------------------------------- */

    public function post(
        string $path,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $path,
          method: 'post',
            data: $data
        );
    }


/*
----------------------------------------------------------------------------- */

    public function put(
        string $path,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $path,
            method: 'put',
            data: $data
        );
    }


/*
----------------------------------------------------------------------------- */

    public function del(
        string $path,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $path,
            method: 'delete',
            data: $data
        );
    }
}