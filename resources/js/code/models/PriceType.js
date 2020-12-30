class PriceType {
    constructor(id,name, margin, created_at, updated_at, deleted_at) {


        if(!arguments.length) {
            this.id = -1;
            this.name = '';
            this.margin = 0;
        }
        this.id = id;
        this.name = name;
        this.margin = margin;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

}

export default PriceType

