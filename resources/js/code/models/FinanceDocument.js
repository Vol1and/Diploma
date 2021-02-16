import Storage from "./Storage";
import Agent from "./Agent";

class FinanceDocument {
    constructor(id = -1,type ,is_set, agent = new Agent(), storage = new Storage(),
                date = "", table_rows = [], income_sum = null, comment = "",doc_sum = 0, created_at = null, updated_at = null, deleted_at = null) {

        this.id = id;
        this.type = type;
        this.is_set = is_set;
        this.agent = agent;
        this.storage = storage;
        this.date = date;
        this.comment = comment;
        this.doc_sum = doc_sum;
        this.table_rows = _.cloneDeep(table_rows);
        this.income_sum = income_sum;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;
        this.deleted_rows = [];
        this.updated_rows = [];
        this.base_rows = _.cloneDeep(table_rows);
    }


    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForCreateIncome() {
        let table_rows = this.prepareRowsToServerIncome(this.table_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            table_rows: table_rows,
            comment: this.comment,
            doc_type_id: this.type,
            doc_sum: this.type === 1 ? this.sumOfIncomePrices() :  this.sumOfSellPrices()
        }
    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForCreateRealization() {
        let table_rows = this.prepareRowsToServerRealization(this.table_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            table_rows: table_rows,
            comment: this.comment,
            doc_type_id: this.type,
            doc_sum: this.type === 1 ? this.sumOfIncomePrices() :  this.sumOfSellPrices()
        }
    }
    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForUpdateRealization() {
        this.fill_updated_rows();
        let updated_rows = this.prepareRowsToServerRealization(this.updated_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            comment: this.comment,
            deleted_rows: this.deleted_rows,
            updated_rows: updated_rows,
            doc_type_id: this.type,
            doc_sum: this.type  === 1  ? this.sumOfIncomePrices() :  this.sumOfSellPrices()
        }
    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForUpdateIncome() {
        this.fill_updated_rows();
        let updated_rows = this.prepareRowsToServerIncome(this.updated_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            comment: this.comment,
            deleted_rows: this.deleted_rows,
            updated_rows: updated_rows,
            doc_type_id: this.type,
            doc_sum: this.type  === 1  ? this.sumOfIncomePrices() :  this.sumOfSellPrices()
        }
    }

    //подгатавливает данные табличной части - каждый из элементов возращает подготовленные данные
    prepareRowsToServerIncome(rows) {
        let items = [];

        rows.forEach(p => {
            items.push(p.getDataForServerIncome());


        })
        return items;

    }
    //подгатавливает данные табличной части - каждый из элементов возращает подготовленные данные
    prepareRowsToServerRealization(rows) {
        let items = [];

        rows.forEach(p => {
            items.push(p.getDataForServerRealization());


        })
        return items;

    }

    //метод проходится про строкам и проверяет - были ли они изменены
    fill_updated_rows() {

        this.updated_rows = [];
        this.table_rows.forEach((p) => {

            if (p.id === -1) {
                this.updated_rows.push(p);
                return;
            }
            let result = this.base_rows.find(x => x.id === p.id);
            if (result == undefined || !result.isEqual(p)) this.updated_rows.push(p);
        })
    }
    sumOfIncomePrices(){
        let sum = 0
        this.table_rows.forEach(p => {
            sum += p.income_price * p.count;
        })
        return sum;
    }
    sumOfSellPrices(){


        let sum = 0
        this.table_rows.forEach(p => {
            sum += p.characteristic.characteristic_price.price * p.count;
        })
        return sum;
    }//

}


export default FinanceDocument
