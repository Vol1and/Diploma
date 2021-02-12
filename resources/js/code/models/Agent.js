class Agent {
    constructor(id = 1, name = " ", billing = " ", address = "", description = "", created_at, updated_at, deleted_at) {

        this.id = id;
        this.name = name;
        this.billing = billing;
        this.description = description;
        this.address = address;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

}

export default Agent

