<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'nama_supplier' => 'supplier 1',
                'alamat' => 'alamat supplier 1',
                'no_telepon' => '123456789012',
                
            ],
            [
                'nama_supplier' => 'supplier 2',
                'alamat' => 'alamat supplier 2',
                'no_telepon' => '098765432109'
            ],
            [
                'nama_supplier' => 'supplier 3',
                'alamat' => 'alamat supplier 3',
                'no_telepon' => '102938475610'
            ]
        ]);
    }
}
