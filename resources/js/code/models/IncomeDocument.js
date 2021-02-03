import Storage from "./Storage";
import Agent from "./Agent";

class IncomeDocument {
    constructor(id = -1, agent = new Agent(), storage = new Storage(),
                date = "", table_rows = [], income_sum = null, comment = "", created_at = null, updated_at = null, deleted_at = null) {

        this.id = id;
        this.agent = agent;
        this.storage = storage;
        this.date = date;
        this.comment = comment;
        this.table_rows = table_rows;
        this.income_sum = income_sum;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;
        this.deleted_rows = [];
        this.updated_rows = [];
        this.base_rows =  [...table_rows];
    }


    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForCreate() {
        let table_rows = this.prepareRowsToServer(this.table_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            table_rows: table_rows,
            comment: this.comment
        }
    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForUpdate() {
        this.fill_updated_rows();
        let updated_rows = this.prepareRowsToServer(this.updated_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            comment: this.comment,
            deleted_rows: this.deleted_rows,
            updated_rows: updated_rows
        }
    }

    //подгатавливает данные табличной части - каждый из элементов возращает подготовленные данные
    prepareRowsToServer(rows) {
        let items = [];

        rows.forEach(p => {
            if (p.isValid()) items.push(p.getDataForServer());

        })
        return items;

    }



    //метод проходится про строкам и проверяет - были ли они изменены
    fill_updated_rows() {

        this.updated_rows = [];
        this.table_rows.forEach((p) => {

            let result = this.base_rows.find(x => x === p );
            console.log(result);
            if (result == null) this.updated_rows.push(p);
        })
    }


}


export default IncomeDocument
