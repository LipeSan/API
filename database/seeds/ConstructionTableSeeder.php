<?php

use Illuminate\Database\Seeder;

class ConstructionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('constructions')->insert([
            'user_id' => 1,
            'name' => 'Obra Teste 1',
            'total' => 988877.50,
        ]);

        DB::table('constructions')->insert([
            'user_id' => 1,
            'name' => 'Obra Teste 2',
            'total' => 455.32,
        ]);

        DB::table('constructions')->insert([
            'user_id' => 1,
            'name' => 'Obra Teste 3',
            'total' => 14000.50,
        ]);
    }
}
