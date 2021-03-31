<?php


namespace App\Services;


use App\Models\Barcode;
use App\Models\BarcodeConnection;
use App\Repositories\BarcodeConnectionsRepository;
use App\Repositories\BarcodesRepository;

class CreateBarcodeService
{
    public function make($data)
    {
        return (new Barcode())->create($data);
    }

    public function makeConnection($data)
    {
        return (new BarcodeConnection())->create($data);
    }

    // функция добавления нового штрихкода к номенклатуре
    public function addNewBarcodeToNomenclature($nomenclature_id, $code)
    {
        $barcodesRepository = app(BarcodesRepository::class);

        $checkBarcode = $barcodesRepository->findByCode($code);

        if ($checkBarcode) return null;
        else {
        $barcode = $this->make(['code' => $code]);
        $barcodeConnection = $this->makeConnection(['nomenclature_id' => $nomenclature_id, 'barcode_id' => $barcode->id]);
        }
        return $barcodeConnection;
    }

    // функция добавления существующего штрихкода к номенклатуре
    public function addExistingBarcodeToNomenclature($nomenclature_id, $code)
    {
        $barcodesRepository = app(BarcodesRepository::class);
        $barcodeConnectionsRepository = app(BarcodeConnectionsRepository::class);

        $checkBarcode = $barcodesRepository->findByCode($code);

        if ($checkBarcode) {

            if($barcodeConnectionsRepository->checkDuplicated($nomenclature_id, $checkBarcode->id) < 1)
            $barcodeConnection = $this->makeConnection(['nomenclature_id' => $nomenclature_id, 'barcode_id' => $checkBarcode->id]);
            else  return null;
            return $barcodeConnection;
        }
        return null;

    }
}
