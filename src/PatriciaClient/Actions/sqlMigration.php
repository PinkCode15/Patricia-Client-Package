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
        (new seeding())->createClientTableSeeder();
        (new seeding())->createClientKeysTableSeeder();
    }

    public static function downMigration()
    {
        (new migrator())->dropClientTable();
        (new migrator())->dropClientKeysTable();

    }

    public static function downSeeders()
    {
        (new seeding())->deleteClientTable();
        (new seeding())->deleteClientKeysTable();

    }

}