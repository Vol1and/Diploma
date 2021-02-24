import Storage from "./Storage";

class WorkPlace {
    constructor(id = -1, name = "", storage = new Storage(),last_access = null,is_opened = false, created_at, updated_at, deleted_at) {

        this.id = id;
        this.name = name;
        this.storage = storage;
        this.last_access = last_access;
        this.is_opened = is_opened;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

    getDataForServer() {
        return {id: this.id, name: this.name, storage_id: this.storage.id}
    }
}

export default WorkPlace

