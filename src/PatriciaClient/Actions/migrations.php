<?php

namespace PatriciaClient\Actions;
use PatriciaClient\Model\DatabaseManager;
class Migrations
{

    function createClientTable()
    {
        $table_attributes= "";
        (new DatabaseManager())->upTable('clients', $table_attributes);
    }

    function createClientKeysTable()
    {
        $table_attributes= "";
        (new DatabaseManager())->upTable('client_keys', $table_attributes);
    }
}
