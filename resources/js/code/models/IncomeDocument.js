import Storage from "./Storage";
import Agent from "./Agent";

class IncomeDocument {
    constructor(id = -1, agent = new Agent(), storage = new Storage(),
                date = "",table_rows = [],income_sum = null, created_at = null, updated_at = null, deleted_at = null) {

        this.id = id;
        this.agent = agent;
        this.storage = storage;
        this.date = date;
        this.table_rows = table_rows;
        this.income_sum = income_sum;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;
    }



    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForServer() {
        let table_rows = this.prepareTableDataToServer();
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            table_rows: table_rows
        }
    }

    //подгатавливает данные табличной части - каждый из элементов возращает подготовленные данные
    prepareTableDataToServer() {
        let items = [];

        this.table_rows.forEach(p => {
            if (p.isValid()) items.push(p.getDataForServer());

        })
        return items;

    }

}


export default IncomeDocument
