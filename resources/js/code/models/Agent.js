class Agent {
    constructor(id,name, billing,address,description, created_at, updated_at, deleted_at) {


        if(!arguments.length) {
            this.id = -1;
            this.name = '';
            this.billing = '';
            this.description = '';
            this.address = '';
        }
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

