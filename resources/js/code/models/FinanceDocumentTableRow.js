import Nomenclature from "./Nomenclature";
import Characteristic from "./Characteristic";

class FinanceDocumentTableRow {
    constructor(id = -1, nomenclature = new Nomenclature(),
                characteristic = new Characteristic(), count = 0, income_price = 0) {

        this.id = id;
        //номенклатура строки
        this.nomenclature = nomenclature;
        //характеристика строки
        this.characteristic = characteristic;
        //количество строки
        this.count = count;
        //цена поступления - используется в поступлениях товара
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
    //валидная ли строка?
    isValid() {
        return !(this.nomenclature.id === -1 ||
            this.nomenclature.characteristic.serial === "" ||
            this.nomenclature.characteristic.expiry_date === "" ||
            this.income_price <= 0 ||
            this.characteristic.characteristic_price.price <= 0 ||
            this.count <= 0);

    }
    //проверка - равны ли строки документа - не по ссылкам, а по значениям
    isEqual(row) {
        if(row === null) return false;
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
