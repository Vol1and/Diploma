import PriceType from "./PriceType";

class Producer {
    constructor(id,name, country, created_at, updated_at, deleted_at) {

        if(!arguments.length) {
            this.id = -1;
            this.name = '';
            this.country = '';
        }
        this.id = id;
        this.name = name;
        this.country = country;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

}

export default Producer

