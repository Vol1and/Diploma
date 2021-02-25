<?php
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsByWorkplacesView extends Migration
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
        VIEW `documents_by_workplaces_view` AS
        SELECT
            `workplaces`.`id` AS `workplace id`,
            `workplaces`.`name` AS `workplace name`,
            `users`.`id` AS `user id`,
            `users`.`name` AS `user`,
            SUM(`finance_documents`.`doc_sum`) AS `total sum`
        FROM
            ((`workplace_document_connections`
            INNER JOIN `finance_documents` ON ((`workplace_document_connections`.`document_id` = `finance_documents`.`id`))
            INNER JOIN `users` ON ((`workplace_document_connections`.`user_id` = `users`.`id`))
            INNER JOIN `workplaces` ON ((`workplace_document_connections`.`workplace_id` = `workplaces`.`id`))))
        GROUP BY `workplaces`.`id`, `users`.`id`;
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
            DROP VIEW IF EXISTS `documents_by_workplaces_view`;
            ";
    }
}
