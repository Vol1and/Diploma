import Nomenclature from "./Nomenclature";

class DocumentTableRow {
    constructor(id= null, table_id = null, nomenclature= new Nomenclature(),
        characteristic = {serial: "", expiry_date: ""},count= 0,income_price= 0, sell_price= 0) {

            this.id = id;
            this.table_id = table_id;
            this.nomenclature = nomenclature;
            this.characteristic = characteristic;
            this.count = count;
            this.income_price = income_price;
            this.sell_price = sell_price;

    }
    getDataForServer(){
        return {id: this.id,table_id: this.table_id, nomenclature_id:  this.nomenclature.id,characteristic_id: this.characteristic.id,
            count: this.count, income_price: this.income_price, sell_price : this.sell_price}
    }


}

export default DocumentTableRow
