<?php


namespace App\Services;


use App\Models\FinanceDocumentTableRow;

class CreateFinanceDocumentTableRowService
{
    public function make($data)
    {
        return (new FinanceDocumentTableRow())->create($data);
    }

    // метод добавления строки документа
    public function fillTableRow($doc, $med, $characteristic_id)
    {
        $createFinanceDocumentTableRowService = app(CreateFinanceDocumentTableRowService::class);

        // заполнение новой строки документа
        $tableRow = $createFinanceDocumentTableRowService->make(['characteristic_id' => $characteristic_id,
            'finance_document_id' => $doc->id,
            'count' => $med['count'], 'price' => $med['income_price']]);
        if (!$tableRow) return response(null,500);

        return $tableRow;
    }
    //public function fill($doc, $med, $characteristic_id)
    //{
    //    $createWareConnectionService = app(CreateWareConnectionService::class);
    //    $createFinanceDocumentTableRowService = app(CreateFinanceDocumentTableRowService::class);
    //
    //    //создание проводки для регистра накопления
    //    $wc = $createWareConnectionService->make(['storage_id'=> $doc->storage_id,
    //        'characteristic_id' => $characteristic_id,'change' => $med['count']]);
    //    if (!$wc) return response(null,500);
    //
    //    // заполнение новой строки документа
    //    $tableRow = $createFinanceDocumentTableRowService->make(['characteristic_id' => $characteristic_id,
    //        'ware_connection_id' =>  $wc->id, 'finance_document_id' => $doc->id,
    //        'count' => $med['count'], 'price' => $med['income_price']]);
    //    if (!$tableRow) return response(null,500);
    //
    //    return $tableRow;
    //}



}
