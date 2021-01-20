import CharacteristicPrice from "./CharacteristicPrice";

class Characteristic {
    constructor(id = -1, serial = "",expiry_date = "",characteristic_price = new CharacteristicPrice(), created_at, updated_at, deleted_at) {

        this.id = id;
        this.serial = serial;
        this.expiry_date = expiry_date;
        this.characteristic_price = characteristic_price;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }


}

export default Characteristic

