<?php


namespace App\Services;


use App\Models\FinanceDocumentTableRow;

class CreateFinanceDocumentTableRowService
{
    // создание сущности СтрокаФинансовогоДокумента
    public function make($data)
    {
        return (new FinanceDocumentTableRow())->create($data);
    }

    // метод добавления строки документа
    public function fillTableRow($doc, $med, $characteristic_id)
    {
        if($doc->doc_type_id == 1) $price = $med['income_price'];
        else $price = $med['sell_price'];

        // заполнение новой строки документа
        $tableRow = $this->make(['characteristic_id' => $characteristic_id,
            'finance_document_id' => $doc->id,
            'count' => $med['count'], 'price' => $price]);
        if (!$tableRow) return response(null,500);

        return $tableRow;
    }
}
