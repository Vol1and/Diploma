//класс производителя
class Producer {
    constructor(id = -1, name = "", country = "", created_at, updated_at, deleted_at) {

        this.id = id;
        //наименование
        this.name = name;
        //страна производителя
        this.country = country;

        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

}

export default Producer

