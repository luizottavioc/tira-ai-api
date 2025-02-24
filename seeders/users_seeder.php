<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@tira.ai',
            'cellphone' => '11999999999',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'is_admin' => true,
            'level' => 1,
        ]);
    }
}
