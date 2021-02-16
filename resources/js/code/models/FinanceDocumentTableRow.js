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
    getDataForServerIncome() {
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
            butches: this.getButchesForRealization()
        }
    }

    //просчитывает и разделяет кол-во строки по партиям
    getButchesForRealization() {
        //массив который будет возвращаться
        let butches = [];
        //копия числа кол-ва строки - с ним будут взаимодействия
        let ware = this.count;
        //foreach по партиям характеристики
        this.characteristic.butch_wares.forEach(p => {
            //если кол-во УЖЕ разбили по партиям - ничего не делаем
            if (ware > 0) {
                //если этой партии не хватает чтобы покрыть кол-во
                if (ware - p.ware > 0) {
                    //клонируем партию - чтобы избавиться от реактивности
                    let butch_copy = _.clone(p);
                    //пушим в butches
                    butches.push(butch_copy);
                    //вычитаем кол-во партии из общего кол-ва
                    ware = ware - p.ware;
                }
                //если этой партии хватает для покрытия кол-ва
                else {
                    //клонируем партию - чтобы избавиться от реактивности
                    let butch_copy = _.clone(p);
                    //присваиваем кол-во партии = остаток общего кол-ва
                    butch_copy.ware = ware;
                    //пушим
                    butches.push(butch_copy);
                    //остаток равен нулю - попартийная разбивка проведена
                    ware = 0;
                }
            }
        })
        return butches;
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
