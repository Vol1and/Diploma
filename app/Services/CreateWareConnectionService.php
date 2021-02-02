<?php


namespace App\Services;


use App\Models\WareConnection;

class CreateWareConnectionService
{
    public function make($med)
    {
        return (new WareConnection())->create($med);
    }


    // внедрение проводки в регистр накопления
    public function pushWareConnection($document_row, $storage_id)
    {
        $createWareConnectionService = app(CreateWareConnectionService::class);

        //создание проводки для регистра накопления
        $wc = $createWareConnectionService->make([ 'storage_id'=> $storage_id,
            'characteristic_id' => $document_row->characteristic_id,'change' => $document_row->count ]);
        if (!$wc) return response(null,500);

        return $wc;
    }
}
