<?php

declare( strict_types = 1 );

namespace Ocolin\PleskApi;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Ocolin\EasySwagger\Errors\InvalidMethodException;
use Ocolin\EasySwagger\Swagger;
use Ocolin\EasyEnv\LoadEnv;

class Client
{
    /**
     * @var Swagger Swagger object.
     */
    private Swagger $swagger;

/* CONSTRUCTOR
----------------------------------------------------------------------------- */

    /**
     * @param Swagger|null $swagger Pre-configured Swagger object
     * @param string|null $host Hostname of plesk server.
     * @param string|null $base_uri Base URI of API.
     * @param string|null $api_key API auth key.
     * @param string|null $api_file Path to Swagger file.
     * @param bool $local Use local .env file.
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
            new LoadEnv( files: __DIR__ . '/../.env' );
        }
        $host     = $host     ?? $_ENV['PLESK_HOST'];
        $base_uri = $base_uri ?? $_ENV['PLESK_BASE_URI'] ?? '';
        $api_key  = $api_key  ?? $_ENV['PLESK_TOKEN'];
        $api_file = $api_file ?? __DIR__ . '/api.v2.json';

        $this->swagger = $swagger ?? new Swagger(
                host: $host,
            base_uri: $base_uri,
            api_file: $api_file,
               token: $api_key,
          token_name: 'X-API-Key'
        );

    }



/* API CALL
----------------------------------------------------------------------------- */

    /**
     * @param string $endpoint API end point.
     * @param string $method HTTP method.
     * @param array<string,mixed>|null $data Body and URI data.
     * @return object|array<string,mixed> API response data.
     * @throws GuzzleException
     * @throws InvalidMethodException
     */
    public function call(
        string $endpoint,
        string $method = 'get',
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
              path: $endpoint,
            method: $method,
              data: $data
        );
    }



/* GET API CALL
----------------------------------------------------------------------------- */

    /**
     * @param string $endpoint API end point.
     * @param array<string,mixed>|null $data Body and URI data.
     * @return object|array<string,mixed> API response data.
     * @throws GuzzleException
     * @throws InvalidMethodException
     */
    public function get(
        string $endpoint,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $endpoint,
            data: $data
        );
    }



/* POST API CALL
----------------------------------------------------------------------------- */

    /**
     * @param string $endpoint API end point.
     * @param array<string,mixed>|null $data Body and URI data.
     * @return object|array<string,mixed> API response data.
     * @throws GuzzleException
     * @throws InvalidMethodException
     */
    public function post(
        string $endpoint,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $endpoint,
          method: 'post',
            data: $data
        );
    }


/* PUT API CALL
----------------------------------------------------------------------------- */

    /**
     * @param string $endpoint API end point.
     * @param array<string,mixed>|null $data Body and URI data.
     * @return object|array<string,mixed> API response data.
     * @throws GuzzleException
     * @throws InvalidMethodException
     */
    public function put(
        string $endpoint,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
            path: $endpoint,
            method: 'put',
            data: $data
        );
    }


/* DELETE CALL
----------------------------------------------------------------------------- */

    /**
     * @param string $endpoint API end point.
     * @param array<string,mixed>|null $data Body and URI data.
     * @return object|array<string,mixed> API response data.
     * @throws GuzzleException
     * @throws InvalidMethodException
     */
    public function del(
        string $endpoint,
        ?array $data   = []
    ) : object|array
    {
        return $this->swagger->path(
              path: $endpoint,
            method: 'delete',
              data: $data
        );
    }
}