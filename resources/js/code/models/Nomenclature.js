import PriceType from "./PriceType";
import Producer from "./Producer";
//Номенклатура
class Nomenclature {
    constructor(id = -1, name = "", producer = new Producer(), price_type = new PriceType(), created_at, updated_at, deleted_at) {


        this.id = id;
        //наименование номенклатуры
        this.name = name;
        //производитель - класс Producer
        this.producer = producer;
        //ценовая группа - класс PriceType
        this.price_type = price_type;

        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

    getDataForServer() {
        return {id: this.id, name: this.name, producer_id: this.producer.id, price_type_id: this.price_type.id}
    }


}

export default Nomenclature

