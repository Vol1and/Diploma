import Nomenclature from "./Nomenclature";
import Characteristic from "./Characteristic";

class StorageDocumentTableRow {
    constructor(id = -1, nomenclature = new Nomenclature(),
                characteristic = new Characteristic(), count = 0) {

        this.id = id;

        this.nomenclature = nomenclature;
        this.characteristic = characteristic;
        this.count = count;

    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForServer() {
        return {
            id: this.id,
            nomenclature_id: this.nomenclature.id,
            characteristic_id: this.characteristic.id,
            characteristic_price_id: this.characteristic.characteristic_price.id,
            characteristic_price_price: this.characteristic.characteristic_price.price,
            count: this.count,

        }
    }

    isValid() {

        return !(this.nomenclature.id === -1 ||
            this.nomenclature.characteristic.serial === "" ||
            this.nomenclature.characteristic.expiry_date === "" ||
            this.characteristic.characteristic_price.price <= 0 ||
            this.count <= 0);

    }

    isEqual(row) {
        if(row === null) return false;
        return this.nomenclature.id === row.nomenclature.id &&
            this.characteristic.id === row.characteristic.id &&
            this.characteristic.characteristic_price.price === row.characteristic.characteristic_price.price &&
            this.count === row.count;
    }


}

export default StorageDocumentTableRow
