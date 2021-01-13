<?php

namespace Database\Seeders;


use App\Models\WareConnection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MedFormSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(DocTypeSeeder::class);
        $this->call(PriceTypeSeeder::class);
        $this->call(ProducerSeeder::class);
        $this->call(CharacteristicPriceSeeder::class);
        $this->call(NomenclatureSeeder::class);
        $this->call(CharacteristicSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(DocConnectionSeeder::class);
        $this->call(WareSeeder::class);
        $this->call(WareConnectionSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
