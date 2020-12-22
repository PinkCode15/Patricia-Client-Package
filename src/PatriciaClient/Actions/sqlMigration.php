<?php
namespace PatriciaClient\Actions;
use PatriciaClient\Model\DatabaseManager;
use Composer\Script\Event;
use PatriciaClient\Actions\Migrations as migrator;
use PatriciaClient\Actions\Seeders as seeding;
class sqlMigration {

    public static function runMigration()
    { 
        (new migrator())->createClientTable();
        (new migrator())->createClientKeysTable();
        $id = (new seeding())->createClientTableSeeder();
        var_dump($id);
        (new seeding())->createClientKeysTableSeeder($id);
    }

    public static function downMigration()
    {
        (new migrator())->dropClientKeysTable();
        (new migrator())->dropClientTable();

    }

    public static function downSeeders()
    {
        (new seeding())->deleteClientKeysTable();
        (new seeding())->deleteClientTable();

    }

}