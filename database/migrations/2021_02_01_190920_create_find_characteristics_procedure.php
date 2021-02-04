<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFindCharacteristicsProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SQL код создания процедуры для вывода характеристик конкретной номенклатуры с параметром: id номенклатуры
        $procedure = "
        CREATE PROCEDURE `find_characteristics_procedure`(nomenclature_id bigint)
            BEGIN
                 SELECT
                `ware_connections`.`characteristic_id` AS `characteristic_id`,
                `nomenclatures`.`name` AS `nomenclature_name`,
                `characteristics`.`nomenclature_id` AS `nomenclature_id`,
                `characteristics`.`serial` AS `serial`,
                `characteristics`.`name` AS `name`,
                `characteristics`.`expiry_date` AS `expiry_date`,
                `ware_connections`.`storage_id` AS `storage_id`,
                SUM(`ware_connections`.`change`) AS `ware`
            FROM
                ((`ware_connections`
                LEFT JOIN `characteristics` ON ((`ware_connections`.`characteristic_id` = `characteristics`.`id`)))
                LEFT JOIN `nomenclatures` ON ((`characteristics`.`nomenclature_id` = `nomenclatures`.`id`)))
            WHERE `characteristics`.`nomenclature_id` = nomenclature_id
            GROUP BY `ware_connections`.`characteristic_id`, `ware_connections`.`storage_id`;
        END
        ";

        // внедрение процедуры в db
        DB::unprepared("DROP procedure IF EXISTS find_characteristics_procedure");
        DB::unprepared($procedure);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('find_characteristics_procedure');
    }
}
