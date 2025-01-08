<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('sports')->insert([
            'name' => 'Futebol',
            'slug' => 'soccer',
        ]);

        Db::table('sports')->insert([
            'name' => 'Futsal',
            'slug' => 'futsal',
        ]);

        Db::table('sports')->insert([
            'name' => 'Voleibol',
            'slug' => 'volleyball',
        ]);

        Db::table('sports')->insert([
            'name' => 'Basquete',
            'slug' => 'basketball',
        ]);
    }
}
