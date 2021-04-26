import Storage from "./Storage";

class WorkPlace {
    constructor(id = -1, name = "", storage = new Storage(),last_access = null,active_user = null, created_at, updated_at, deleted_at) {

        this.id = id;
        //наименование рабочего места
        this.name = name;
        //склад - class Storage
        this.storage = storage;
        //последнее открытие-закрытие
        this.last_access = last_access;
        //активный пользователь - отображается пользователь, который открыл смену (если смена открыта), либо 0, если она закрыта
        this.active_user = active_user;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

    getDataForServer() {
        return {id: this.id, name: this.name, storage_id: this.storage.id}
    }
}

export default WorkPlace

