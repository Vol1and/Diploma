<?php


namespace App\Services;


use App\Models\WareConnection;
use App\Repositories\ButchNumberConnectionsRepository;

class CreateWareConnectionService
{
    public function make($med)
    {
        return (new WareConnection())->create($med);
    }


    // внедрение проводки в регистр накопления
    public function pushWareConnection($document_row, $doc)
    {
        $createWareConnectionService = app(CreateWareConnectionService::class);
        $butchNumberConnectionRepository = app(ButchNumberConnectionsRepository::class);

        // поиск номера партии если добавление в документ получения товара
        if($doc->doc_type_id < 2) $bn = $butchNumberConnectionRepository->findByButchNumber($doc->id);

        // иначе если это расходный (другой документ) партия берётся из строки документа
        else $bn = $butchNumberConnectionRepository->findByButchNumber($document_row->butch_number);



        //создание проводки для регистра накопления
        if ($bn) $wc = $createWareConnectionService->make([ 'storage_id'=> $doc->storage_id,
            'characteristic_id' => $document_row->characteristic_id, 'change' => $document_row->count , 'butch_number_connection_id' => $bn->id ]);
        if (!$wc) return response(null,500);

        return $wc;
    }
}
