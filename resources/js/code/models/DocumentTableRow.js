import Nomenclature from "./Nomenclature";
import Characteristic from "./Characteristic";

class DocumentTableRow {
    constructor(id = -1, table_id = null, nomenclature = new Nomenclature(),
                characteristic = new Characteristic(), count = 0, income_price = 0) {

        this.id = id;
        this.table_id = table_id;
        this.nomenclature = nomenclature;
        this.characteristic = characteristic;
        this.count = count;
        this.income_price = income_price;


    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForServer() {
        return {
            id: this.id,
            table_id: this.table_id,
            nomenclature_id: this.nomenclature.id,
            characteristic_id: this.characteristic.id,
            serial: this.characteristic.serial,
            expiry_date: this.characteristic.expiry_date,
            count: this.count,
            income_price: this.income_price,
            sell_price : this.characteristic.characteristic_price.price
        }
    }

    isValid() {

        return !(this.nomenclature.id === -1 ||
                 this.nomenclature.characteristic.serial === "" ||
                 this.nomenclature.characteristic.expiry_date === "" ||
                 this.income_price <= 0 ||
                 this.sell_price <= 0 ||
                 this.count <= 0);

    }


}

export default DocumentTableRow
