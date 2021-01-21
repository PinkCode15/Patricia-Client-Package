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

```
Run Patricia::migrate();
to migrate your tables and default seeders
```

### `Run Migration`
    Run migration
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

      Patricia::createClient(string $clientName, string $clientRole) 
      or
      $patricia->createClient(string $clientName, string $clientRole)

      clientRole is either `admin` or `user`
      

### `Create Client Key`

    Patricia::createClientKey(int $clientId, string $clientKeyName);
    $patricia->createClientKey(int $clientId, string $clientKeyName);
     
### `Update Client`
    Patricia::updateClient(string $ClientUuid, array $array);
    $patricia->updateClient(string $ClientUuid, array $array);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King',
        'is_blocked' => 1
    ];

 
### `Update Client Keys`

    Patricia::updateClientKeys(int $clientKeyId, array $array);
    $patricia->updateClientKeys(int $clientKeyId, array $array);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King Key',
        'is_blocked' => 1
    ];

 
### `Get Client Detail`

    get a client details based on column attribute

    Patricia::getClient(string $columnName, string $columnValue);
    $patricia->getClient(string $columnName, string $columnValue);

    $array should contain the columns and respective values;
    example $array = [
        'name' => 'Patricia King Key',
        'is_blocked' => 1
    ];

### `Get Client Keys Detail`

    returns all instances of a client key

    Patricia::getClientKeys(int $clientKeyId);
    $patricia->getClientKeys(int $clientKeyId);


### `Get Client key Detail`

    returns the first instance of a client key

    Patricia::getClientKey(int $clientKeyId);
    $patricia->getClientKey(int $clientKeyId);


### `Delete client`

    Patricia::deleteClient(string $clientUuid);
    $patricia->deleteClient(string $clientUuid);



### `Delete client key`

    Patricia::deleteClientKey(int $clientKeyId);
    $patricia->deleteClientKey(int $clientKeyId);


## `Helper functions`

### `Check if user is admin`
    isAdmin(string $apiKey)

### `Check if user is authenticated`
    isAuthenticated(string $apiKey)

### `Get a client details`
    getClient(string $prop, string $value)
    `prop represents a column`
    `value represents the value for query`

    
## License

    Released under the MIT License. See the bundled LICENSE file for details.

## Contributions
   
   Open to contributions from anyone, PR's can be made and would be accepted. Thanks and good luck
