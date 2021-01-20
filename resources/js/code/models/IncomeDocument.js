import Storage from "./Storage";
import Agent from "./Agent";

class IncomeDocument {
    constructor(id = -1, agent = new Agent(), storage = new Storage(),
                date = "", doc_connections = [],income_sum = null, created_at = null, updated_at = null, deleted_at = null) {

        this.id = id;
        this.agent = agent;
        this.storage = storage;
        this.date = date;
        this.doc_connections = doc_connections;
        this.income_sum = income_sum;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;
    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForServer() {
        let doc_connections = this.prepareTableDataToServer();
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            doc_connections: doc_connections
        }
    }

    //подгатавливает данные табличной части - каждый из элементов возращает подготовленные данные
    prepareTableDataToServer() {
        let items = [];

        this.doc_connections.forEach(p => {
            if (p.isValid()) items.push(p.getDataForServer());

        })
        return items;

    }

}


export default IncomeDocument
