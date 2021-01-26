<?php

use Illuminate\Database\Migrations\Migration;

class CreateWaresTable extends Migration
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
        VIEW `diploma`.`wares` AS
         SELECT

        `diploma`.`ware_connections`.`characteristic_id` AS `characteristic_id`,
                `diploma`.`ware_connections`.`storage_id` AS `storage_id`,
        SUM(`diploma`.`ware_connections`.`change`) AS ware
    FROM
        `diploma`.`ware_connections`
    GROUP BY characteristic_id, storage_id
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
            DROP VIEW IF EXISTS `wares`;
            ";
    }
}
