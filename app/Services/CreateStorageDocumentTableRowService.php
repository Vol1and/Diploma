<?php


namespace App\Services;

use App\Models\StorageDocumentTableRow;

class CreateStorageDocumentTableRowService
{
    // создание сущности СтрокаСкладскогоДокумента
    public function make($data)
    {
        return (new StorageDocumentTableRow())->create($data);
    }


    // метод добавления строки документа
    public function fillTableRow($doc, $med, $characteristic_id)
    {
        // заполнение новой строки документа
        $tableRow = $this->make(['characteristic_id' => $characteristic_id,
            'storage_document_id' => $doc->id,
            'count' => $med['count'], 'price' => $med['characteristic_price_price']]);
        if (!$tableRow) return response(null,500);

        return $tableRow;
    }

}

