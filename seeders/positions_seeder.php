<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->soccerPositions();
    }

    private function soccerPositions(): void
    {
        $soccerId = Db::table('sports')->where('slug', 'soccer')->first()->id;

        Db::table('positions')->insert([
            'name' => 'Goleiro',
            'sport_id' => $soccerId,
            'slug' => 'soccer-goalkeeper',
            'acronym' => 'GL',
        ]);

        Db::table('positions')->insert([
            'name' => 'Lateral Direito',
            'sport_id' => $soccerId,
            'slug' => 'soccer-right-back',
            'acronym' => 'LD',
        ]);

        Db::table('positions')->insert([
            'name' => 'Zagueiro',
            'sport_id' => $soccerId,
            'slug' => 'soccer-central-back',
            'acronym' => 'ZG',
        ]);

        Db::table('positions')->insert([
            'name' => 'Lateral Esquerdo',
            'sport_id' => $soccerId,
            'slug' => 'soccer-left-back',
            'acronym' => 'LE',
        ]);

        Db::table('positions')->insert([
            'name' => 'Volante',
            'sport_id' => $soccerId,
            'slug' => 'soccer-central-defensive-midfielder',
            'acronym' => 'VL',
        ]);

        Db::table('positions')->insert([
            'name' => 'Meia',
            'sport_id' => $soccerId,
            'slug' => 'soccer-central-midfielder',
            'acronym' => 'MC',
        ]);

        Db::table('positions')->insert([
            'name' => 'Ponta Direita',
            'sport_id' => $soccerId,
            'slug' => 'soccer-right-winger',
            'acronym' => 'PD',
        ]);

        Db::table('positions')->insert([
            'name' => 'Atacante',
            'sport_id' => $soccerId,
            'slug' => 'soccer-forward',
            'acronym' => 'AT',
        ]);

        Db::table('positions')->insert([
            'name' => 'Ponta Esquerda',
            'sport_id' => $soccerId,
            'slug' => 'soccer-left-winger',
            'acronym' => 'PE',
        ]);
    }
}
