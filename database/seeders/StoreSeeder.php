<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'id' => 1,
            'name' => 'Leitura Bookstore',
            'address' => 'Afonso Pena Avenue, 879, Belo Horizonte, Minas Gerais, Brazil',
            'active' => true,
        ]);
    }
}
