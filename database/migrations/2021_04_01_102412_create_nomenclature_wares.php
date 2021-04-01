<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomenclatureWares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('

            CREATE
        VIEW `diploma`.`nomenclature_wares` AS
        SELECT
            `diploma`.`nomenclatures`.`id` AS `nomenclature_id`,
            `diploma`.`ware_connections`.`storage_id` AS `storage_id`,
            SUM(`diploma`.`ware_connections`.`change`) AS ware
        FROM
            ((`ware_connections`
                JOIN `characteristics` ON ((`ware_connections`.`characteristic_id` = `characteristics`.`id`))
                JOIN `nomenclatures` ON ((`characteristics`.`nomenclature_id` = `nomenclatures`.`id`))
            ))
        GROUP BY nomenclatures.id, storage_id
        HAVING ware > 0
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return "
            DROP VIEW IF EXISTS `nomenclature_wares`;
            ";
    }
}
