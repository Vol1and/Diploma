import PriceType from "./PriceType";
import Producer from "./Producer";

class Nomenclature {
    constructor(id, name, producer, price_type, created_at, updated_at, deleted_at) {

        this.characteristic = {expiry_date: "2024/12/12", serial : "123"};
        if(!arguments.length) {
            this.id = -1;
            this.name = '';
            this.producer = new Producer(-1, '',null);
            this.price_type = new PriceType(-1,'', null);
        }
        else {
            this.id = id;
            this.name = name;
            this.producer = producer;
            this.price_type = price_type;
            this.created_at = created_at;
            this.updated_at = updated_at;
            this.deleted_at = deleted_at;
        }
    }

    getDataForServer(){
        return {id: this.id, name: this.name, producer_id : this.producer.id, price_type_id: this.price_type.id}
    }


}

export default Nomenclature

