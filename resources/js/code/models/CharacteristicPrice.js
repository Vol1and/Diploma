//класс Цены характеристики - используется для того, чтобы можно было увидеть
//динамику цен в разрезе updated_at - чем новее дата тем свежее цена
class CharacteristicPrice {
    constructor(id = null, price = 0, created_at, updated_at, deleted_at) {

        this.id = id;
        //цена характеристики
        this.price = price;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;

    }

}

export default CharacteristicPrice

