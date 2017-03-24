<?php

use Illuminate\Database\Seeder;

class WorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('works')->insert([
            'user_id' => 1,
            'name' => 'Obra Teste 1',
            'total' => 9888777.50,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('works')->insert([
            'user_id' => 1,
            'name' => 'Obra Teste 2',
            'total' => 455.32,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('works')->insert([
            'user_id' => 1,
            'name' => 'Obra Teste 3',
            'total' => 14000.50,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
