class PriceType {
    constructor(id = -1, name = "", margin = 0, created_at, updated_at, deleted_at) {

        this.id = id;
        this.name = name;
        this.margin = margin;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

}

export default PriceType

