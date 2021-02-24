<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['kategori' => 'Sabun'],
            ['kategori' => 'Mie Instan'],
            ['kategori' => 'peralatan belajar']
        ]);
    }
}
