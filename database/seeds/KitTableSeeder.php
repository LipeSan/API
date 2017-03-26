<?php

use Illuminate\Database\Seeder;

class KitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kits')->insert([
            'code' => 11111,
            'name' => 'Kit Teste 1',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua.',
            'unit' => 'unidade1',
            'price_origin' => 'preço de origen 1',
            'image' => 'imagem_kit_01.jpg',
            'price' => 456234.00,
            'state' => 'RS'
        ]);

        DB::table('kits')->insert([
            'code' => 22222,
            'name' => 'Kit Teste 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua.',
            'unit' => 'unidade2',
            'price_origin' => 'preço de origen 2',
            'image' => 'imagem_kit_02.jpg',
            'price' => 212347.00,
            'state' => 'SC'
        ]);

        DB::table('kits')->insert([
            'code' => 33333,
            'name' => 'Kit Teste 3',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua.',
            'unit' => 'unidade1',
            'price_origin' => 'preço de origen 3',
            'image' => 'imagem_kit_03.jpg',
            'price' => 28597.10,
            'state' => 'RJ'
        ]);
    }
}
