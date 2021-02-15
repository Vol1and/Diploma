import Nomenclature from "./Nomenclature";
import Characteristic from "./Characteristic";

class FinanceDocumentTableRow {
    constructor(id = -1, nomenclature = new Nomenclature(),
                characteristic = new Characteristic(), count = 0, income_price = 0) {

        this.id = id;

        this.nomenclature = nomenclature;
        this.characteristic = characteristic;
        this.count = count;
        this.income_price = income_price;
    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForServer() {
        return {
            id: this.id,
            nomenclature_id: this.nomenclature.id,
            characteristic_id: this.characteristic.id,
            characteristic_price_id: this.characteristic.characteristic_price.id,
            serial: this.characteristic.serial,
            expiry_date: this.characteristic.expiry_date,
            count: this.count,
            income_price: this.income_price,
            sell_price: this.characteristic.characteristic_price.price
        }
    }

    getDataForServerRealization() {

        let butches = [];
        let ware = this.count;
        this.characteristic.butch_wares.forEach(p =>{

            if(ware > 0) {
                if (ware - p.ware > 0) {
                    let butch_copy = _.clone(p);
                    butches.push(butch_copy);
                    ware = ware - p.ware;
                } else {
                    let butch_copy = _.clone(p);
                    butch_copy.ware = ware;
                    butches.push(butch_copy);
                    ware = 0;
                }
            }

        })

        return {
            id: this.id,
            nomenclature_id: this.nomenclature.id,
            characteristic_id: this.characteristic.id,
            characteristic_price_id: this.characteristic.characteristic_price.id,
            serial: this.characteristic.serial,
            expiry_date: this.characteristic.expiry_date,
            count: this.count,
            income_price: this.income_price,
            sell_price: this.characteristic.characteristic_price.price,
            butches : butches
        }
    }



    isValid() {

        return !(this.nomenclature.id === -1 ||
            this.nomenclature.characteristic.serial === "" ||
            this.nomenclature.characteristic.expiry_date === "" ||
            this.income_price <= 0 ||
            this.characteristic.characteristic_price.price <= 0 ||
            this.count <= 0);

    }

    isEqual(row) {
        return this.nomenclature.id === row.nomenclature.id &&
            this.characteristic.id === row.characteristic.id &&
            this.characteristic.serial === row.characteristic.serial &&
            this.characteristic.expiry_date === row.characteristic.expiry_date &&
            this.income_price === row.income_price &&
            this.characteristic.characteristic_price.price === row.characteristic.characteristic_price.price &&
            this.count === row.count;
    }


}

export default FinanceDocumentTableRow
