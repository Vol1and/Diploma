<?php

use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicButchesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement(/** @lang MySQL */ '
            CREATE
        VIEW `characteristic_butches_view` AS
        SELECT
            `ware_connections`.`characteristic_id` AS `characteristic_id`,
            `butch_number_connections`.`butch_number` AS `butch`,
            `ware_connections`.`storage_id` AS `storage_id`,
            SUM(`ware_connections`.`change`) AS `ware`
        FROM
            ((`ware_connections`
            INNER JOIN `butch_number_connections` ON ((`ware_connections`.`butch_number_connection_id` = `butch_number_connections`.`id`))
            LEFT JOIN `characteristics` ON ((`ware_connections`.`characteristic_id` = `characteristics`.`id`))))
            WHERE butch_number_connections.butch_number > 0
        GROUP BY `ware_connections`.`characteristic_id`, `butch_number_connections`.`butch_number`, `ware_connections`.`storage_id`;
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
            DROP VIEW IF EXISTS `characteristic_butches_view`;
            ";
    }
}
