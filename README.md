# PleskAPI
Simple REST API Client for Plesk web hosting server

## Usage

### Environment variables

#### PLESK_HOST

Plesk server name

Example: host1.domain.com:8443

#### PLESK_BASE_URI

URI of API on server.

Example: /api/v2/

#### PLESK_TOKEN

Auth token for API server

Example: a28ef853-65eb-ba88-eb71-04062f1cc168

### Constructor arguments

#### $swagger

Optional Swagger object pre-configured. 

#### $host

Name of Plesk server. 

Example: host1.domain.com:8443

#### $base_uri

URI of API on server.

Example: /api/v2/

#### $api_key

Auth token for API server.

Example: a28ef853-65eb-ba88-eb71-04062f1cc168

#### $api_file

Alternate Swagger config file.

Example: '/path/to/api.v2.json'

#### $local

Load local .env file in root of library folder.

### Create Client with Argument

```
$client = new \Ocolin\PleskApi\Client(
       host: 'host1.domain.com:8443',
    api_key: 'a28ef853-65eb-ba88-eb71-04062f1cc168'  
);
```

### Create client with environment variables

```
$_ENV['PLESK_HOST'] = 'host1.domain.com:8443';
$_ENV['PLESK_TOKEN'] = 'a28ef853-65eb-ba88-eb71-04062f1cc168';

$client = new \Ocolin\PleskApi\Client();
```

## Functions

### call

```
$output = $client->call(
    endpoint: '/clients',
      method: 'post'
        data: [...]
);
```

### get

Get a resource.

```
$output = $client->get( endpoint: '/clients' );
```

### post

Create a resource.

```
$output = $client->post(
    endpoint: '/clients',
        data: [...]
);
```

### put

Update a resource.

```
$output = $client->put(
    endpoint: '/clients/{id}',
        data: [ id: 1234, ...]
);
```

### del

Delete a resource.

```
$output = $client->del(
    endpoint: '/clients/{id}',
        data: [ id: 1234 ]
);
```
