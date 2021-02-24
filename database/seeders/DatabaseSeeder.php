<?php

namespace Database\Seeders;


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
        $this->call(StorageSeeder::class);
        $this->call(WorkplaceSeeder::class);
        $this->call(MedFormSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(DocTypeSeeder::class);
        $this->call(PriceTypeSeeder::class);
        $this->call(ProducerSeeder::class);
        $this->call(CharacteristicPriceSeeder::class);
        $this->call(NomenclatureSeeder::class);
        $this->call(CharacteristicSeeder::class);
        $this->call(FinanceDocumentSeeder::class);
        $this->call(StorageDocumentSeeder::class);
        $this->call(ButchNumberConnectionSeeder::class);
        $this->call(WareConnectionSeeder::class);
        $this->call(FinanceDocumentTableRowSeeder::class);
        $this->call(StorageDocumentTableRowSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
