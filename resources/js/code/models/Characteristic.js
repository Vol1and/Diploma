import CharacteristicPrice from "./CharacteristicPrice";

//класс Характеристики -
class Characteristic {
    constructor(id = -1, name = "", serial = "",expiry_date = "",characteristic_price = new CharacteristicPrice(),ware, created_at, updated_at, deleted_at) {

        this.id = id;
        //представление характеристики в формате [Серия; Срок годности]. Вычисляется computed-столбцом базы данных
        this.name = name;
        //серия характеристики
        this.serial = serial;
        //срок годности характеристики
        this.expiry_date = expiry_date;
        //цена характеристики - объект CharacteristicPrice
        this.characteristic_price = characteristic_price;
        //остаток характеристики (в некоторых случаях пуст)
        this.ware = ware;

        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;


    }


}

export default Characteristic

