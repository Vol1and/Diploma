import Storage from "./Storage";
import Agent from "./Agent";
import cloneDeep from 'lodash/clonedeep';

//класс финансового документа - поступление товаров или реализация товаров
class FinanceDocument {
    constructor(id = -1,type ,is_set, agent = new Agent(), storage = new Storage(),
                date = "", table_rows = [], comment = "",doc_sum = 0, created_at = null, updated_at = null, deleted_at = null) {

        this.id = id;
        //тип документа - приходный или расходный
        this.type = type;
        //булево - проведен документ или нет
        this.is_set = is_set;
        //контрагент - класс Agent
        this.agent = agent;
        //склад - класс Storage
        this.storage = storage;
        //дата
        this.date = date;
        //комментарий - обычная nullable строка
        this.comment = comment;
        //doc_sum - общая сумма документа по всем строкам
        this.doc_sum = doc_sum;
        //table_rows - табличная часть
        //при конструкторе клонируется cloneDeep методом Lodash для избавления от референсов
        this.table_rows = cloneDeep(table_rows);
        //массив с id's удаленных строк - сюда попадают строки, которые были удалены во время редактирования
        this.deleted_rows = [];
        //измененные строки - сюда попадают строки, которые были изменены при редактированы
        this.updated_rows = [];
        //исходные строки - при создании клонируются Lodash и используются для выявляения updated_rows
        this.base_rows = cloneDeep(table_rows);

        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;
    }


    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    getDataForCreate() {
        let table_rows = this.prepareRowsToServer(this.table_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            table_rows: table_rows,
            comment: this.comment,
            doc_type_id: this.type,
            doc_sum: this.type === 1 ? this.sumOfIncomePrices() :  this.sumOfSellPrices()
        }
    }

    //возвращает ассоциативный массив, который можно отправлять на сервер - в нем нет лишних полей, и тяжелых объектов - только id
    //отличается от getDataForCreate() тем, что отправляет только отредактированные строки
    getDataForUpdate() {
        this.fill_updated_rows();
        let updated_rows = this.prepareRowsToServer(this.updated_rows);
        return {
            id: this.id,
            agent_id: this.agent.id,
            storage_id: this.storage.id,
            date: this.date,
            comment: this.comment,
            deleted_rows: this.deleted_rows,
            updated_rows: updated_rows,
            doc_type_id: this.type,
            doc_sum: this.type  === 1  ? this.sumOfIncomePrices() :  this.sumOfSellPrices()
        }
    }

    //подготавливает данные табличной части - каждый из элементов возращает подготовленные данные
    prepareRowsToServer(rows) {
        let items = [];

        rows.forEach(p => {
            items.push(p.getDataForServer());


        })
        return items;

    }
    //подготавливает данные табличной части - каждый из элементов возращает подготовленные данные
    //метод проходится про строкам и проверяет - были ли они изменены
    fill_updated_rows() {
        this.updated_rows = [];
        this.table_rows.forEach((p) => {

            if (p.id === -1) {
                this.updated_rows.push(p);
                return;
            }

            let result = this.base_rows.find(x => x.id === p.id);
            if (result === undefined || !result.isEqual(p)) this.updated_rows.push(p);
        })
    }
    //метод, вычисляющий сумму документа для поступлений товаров
    sumOfIncomePrices(){
        let sum = 0
        this.table_rows.forEach(p => {
            sum += p.income_price * p.count;
        })
        return sum;
    }
    //метод, вычисляющий сумму документа для реализации товаров
    sumOfSellPrices(){

        let sum = 0
        this.table_rows.forEach(p => {
            sum += p.characteristic.characteristic_price.price * p.count;
        })
        return sum;
    }
    //метод возвращает данные, кототрые нужны для создания чека в рабочем месте кассира
    //склад, дата, комментарий в этом случае не нужны, они берутся извне
    getDataForCashier(){
        let items = [];

        this.table_rows.forEach(p => {
            items.push({characteristic_id: p.characteristic.id, count: p.count });
        })
        return items;
    }
}


export default FinanceDocument
