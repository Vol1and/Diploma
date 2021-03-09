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
        CREATE PROCEDURE `find_characteristics_procedure`(nomenclature_id bigint, storage_id bigint)
            BEGIN
                 SELECT
                `ware_connections`.`characteristic_id` AS `characteristic_id`,
                `nomenclatures`.`name` AS `nomenclature_name`,
                `characteristics`.`nomenclature_id` AS `nomenclature_id`,
                `characteristics`.`serial` AS `serial`,
                `butch_number_connections`.`butch_number` AS `butch`,
                `characteristic_prices`.`id` as `characteristic_price_id`,
                `characteristic_prices`.`price` as `characteristic_price`,
                `characteristics`.`name` AS `name`,
                `characteristics`.`expiry_date` AS `expiry_date`,
                `ware_connections`.`storage_id` AS `storage_id`,
                SUM(`ware_connections`.`change`) AS `ware`
            FROM
                ((`ware_connections`
                INNER JOIN `butch_number_connections` ON ((`ware_connections`.`butch_number_connection_id` = `butch_number_connections`.`id`))
                LEFT JOIN `characteristics` ON ((`ware_connections`.`characteristic_id` = `characteristics`.`id`))
                LEFT JOIN `characteristic_prices` ON ((`characteristics`.`characteristic_price_id` = `characteristic_prices`.`id`))
                LEFT JOIN `nomenclatures` ON ((`characteristics`.`nomenclature_id` = `nomenclatures`.`id`))))
            WHERE `characteristics`.`nomenclature_id` = nomenclature_id AND `ware_connections`.storage_id = storage_id
                AND `butch_number_connections`.butch_number > 0
            GROUP BY `ware_connections`.`characteristic_id`, `ware_connections`.`storage_id`, `butch_number_connections`.`butch_number`;
        END
        ";

        $procedure2 = "
        CREATE PROCEDURE `find_characteristic_ware_butches`(characteristic_id bigint, storage_id bigint)
        BEGIN
            SELECT
                `butch_number_connections`.`id` AS `id`,
                `butch_number_connections`.`butch_number` AS `butch`,
                SUM(`ware_connections`.`change`) AS `ware`
            FROM
                ((`ware_connections`
                INNER JOIN `butch_number_connections` ON ((`ware_connections`.`butch_number_connection_id` = `butch_number_connections`.`id`))))
            WHERE `ware_connections`.characteristic_id = characteristic_id
            AND  `ware_connections`.storage_id = storage_id
            AND `butch_number_connections`.butch_number > 0
            GROUP BY `butch_number_connections`.`id`
            having ware > 0;
        END
        ";

        $procedure3 = "
        CREATE PROCEDURE `find_all_finance_connections`(date_start date, date_end date)
        BEGIN
            SELECT
                `accounting_connections`.`document_id` AS `id`,
                `accounting_connections`.`date` AS `date`,
                `accounting_connections`.`change` AS `change`,
                `workplace_document_connections`.`workplace_id` AS `workplace`,
                `workplace_document_connections`.`user_id` AS `user`
            FROM
                ((`accounting_connections`
                LEFT JOIN `workplace_document_connections` ON ((`accounting_connections`.`document_id` = `workplace_document_connections`.`document_id`))))
            WHERE `accounting_connections`.date >= date_start
            AND `accounting_connections`.date <= date_end;
        END
        ";

        //процедура для формирования графика: ДАТА - СУММА ЧЕКОВ
        $procedure4 =
            "
        CREATE PROCEDURE `find_all_cash`(date_start date, date_end date)
        BEGIN
            SELECT
                DATE(`accounting_connections`.`date`) AS `date`,
                SUM(`accounting_connections`.`change`) AS `summing`
            FROM
                ((`accounting_connections`
                LEFT JOIN `workplace_document_connections` ON ((`accounting_connections`.`document_id` = `workplace_document_connections`.`document_id`))
                JOIN `finance_documents` ON ((`accounting_connections`.`document_id` = `finance_documents`.`id`))))
            WHERE `accounting_connections`.date >= date_start
            AND `accounting_connections`.date <= date_end
            AND `finance_documents`.`doc_type_id` = 2
            GROUP BY CAST(`accounting_connections`.`date` AS DATE)
            ORDER BY CAST(`accounting_connections`.`date` AS DATE);
        END
        ";

        // внедрение процедуры в db
        DB::unprepared("DROP procedure IF EXISTS find_characteristics_procedure");
        DB::unprepared($procedure);
        DB::unprepared("DROP procedure IF EXISTS find_characteristic_ware_butches");
        DB::unprepared($procedure2);
        DB::unprepared("DROP procedure IF EXISTS find_all_finance_connections");
        DB::unprepared($procedure3);
        DB::unprepared("DROP procedure IF EXISTS find_all_cash");
        DB::unprepared($procedure4);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('find_characteristics_procedure');
        Schema::dropIfExists('find_characteristic_ware_butches');
        Schema::dropIfExists('find_all_finance_connections');
        Schema::dropIfExists('find_all_cash');
    }
}
