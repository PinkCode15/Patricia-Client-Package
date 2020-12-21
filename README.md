# Patricia-Client-Package
PHP library for Patricia Technologies for management of client and client key 

 
# Installation 
```sh
composer require stacey/patricia-client-package

```

```
require_once 'vendor/autoload.php';
```

```
use PatriciaClient\Patricia;
$patricia = new Patricia();
```

### `Run Migration`
    Patricia::migrate();
    or
    $patricia->migrate();


### `Drop Table`
    Patricia::rollback_migrate();
     or
    $patricia->rollback_migrate();

### `Rollback Seeder`
    Patricia::rollback_seeders();
     or
    $patricia->ollback_seeders();

### `Create Client`

      Patricia::create_client(String $clientName, String $clientRole) 
      or
      $patricia->create_client(String $clientName, String $clientRole)

      clientRole is either `admin` or `user`
      

### `Create Client Key`

    Patricia::create_client_key(int $clientId, String $clientKeyName);
    $patricia->create_client_key(int $clientId, String $clientKeyName);
     
### `Update Client`
    Patricia::update_client(string $ClientUuid, array $array);
    $patricia->update_client(string $ClientUuid, array $array);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King',
        'is_blocked' => 1
    ];

 
### `Update Client Keys`

    Patricia::update_client_keys(Int $clientKeyId, array $array);
    $patricia->update_client_keys(Int $clientKeyId, array $array);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King Key',
        'is_blocked' => 1
    ];

 
### `Get Client Detail`

    get a client details based on column attribute

    Patricia::get_client(string $columnName, string $columnValue);
    $patricia->get_client(string $columnName, string $columnValue);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King Key',
        'is_blocked' => 1
    ];

### `Get Client Keys Detail`

    returns all instances of a client key

    Patricia::get_client_keys(Int $clientKeyId);
    $patricia->get_client_keys(Int $clientKeyId);


### `Get Client key Detail`

    returns the first instance of a client key

    Patricia::get_client_key(Int $clientKeyId);
    $patricia->get_client_key(Int $clientKeyId);


### `Delete client`

    Patricia::delete_client(String $clientUuid);
    $patricia->delete_client(String $clientUuid);



### `Delete client key`

    Patricia::delete_client_key(Int $clientKeyId);
    $patricia->delete_client_key(Int $clientKeyId);


## `Helper functions`

### `Check if user is admin`
    is_admin(String $apiKey)

### `Check if user is authenticated`
    is_authenticated(String $apiKey)

### `Get a client details`
    get_client(String $prop, String $value)
    `prop represents a column`
    `value represents the value for query`

    
## License

    Released under the MIT License. See the bundled LICENSE file for details.

## Contributions
   
   Open to contributions from anyone, PR's can be made and would be accepted. Thanks and good luck
