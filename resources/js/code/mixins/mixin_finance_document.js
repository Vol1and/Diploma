//данный код будет включен во все Document-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
import IncomeDocument from "../models/IncomeDocument";
import FinanceDocumentTableRow from "../models/FinanceDocumentTableRow";

export default {


    data: function () {
        return {

            errors: [],
            //переменная, которая помогает отображать компоненты выбора (например, NomenclatureChoose или ProducerChoose)
            choosing_state: 0,
            //показывает, получены ли данные с сервера - при loaded - false не доступна submit-кнопка
            loaded: true,
            //модель, в которой будут находиться данные
            item: new IncomeDocument(null),

            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: new FinanceDocumentTableRow(),
            hover_row: null

        };
    },

    methods: {

        showErrors() {
            this.errors.forEach(item => this.$notify.error({
                title: 'Ошибка!',
                message: item,
            }));
        },
        //обработчик события cell-dblclick - обрабатывает двойной щелчок по выбраной клетке
        //чисто технически, его можно переделать в rowEdit, но пока не горит
        rowEdit(row) {
            //присваивает выбранную строку в selectingRow - читать выше
            this.selectingRow = row;
        }
        ,
        rowHover(item) {

            this.hover_row = item;
            this.selectingRow = new FinanceDocumentTableRow();
        },
        //удаление строки табличной части
        deleteSelected() {

            //если не выбрана ни одна строка - ничего не делаем
            if (this.hover_row == null) return;

            //удаляем строку из табличной части
            let index = this.item.table_rows.indexOf(this.hover_row);
            this.item.table_rows.splice(index, 1);
            //если удалена новая строка и она не сохранена на сервере - не заносим в deleted_rows
            if (this.hover_row.id == null) return;


            //вносим данные в deleted_rows
            this.item.deleted_rows.push(this.hover_row.id);
            //чтобы сбросился выбор
            this.hover_row = null

        },
        //метод добавляет новую пустую строку в массив table_rows, и, соответственно в табличную часть формы
        addToTable() {
            //id = -1, table_id используется чтобы нумерация строк происходила с 1 и дальше
            //TODO: при реализации удаления строки из таблицы, переделать нумерацию, чтобы было max_id + 1

            this.item.table_rows.push(new FinanceDocumentTableRow(null));

            //console.log(this.item.table_rows)
        }
        ,
        selectingStorage() {
            this.choosing_state = 3;
        },

        selectingAgent() {
            this.choosing_state = 1;
        }
        ,
        selectingNomenclature() {
            this.choosing_state = 2;
        }
        ,
        selectingCharacteristic() {
            this.choosing_state = 4;
        }
        ,
        onSelectedCharacteristic(data) {
            this.selectingRow.characteristic = data.characteristic;
            this.choosing_state = 0;
        },
        onSelectedAgent(data) {
            this.item.agent = data.agent;
            this.choosing_state = 0;
        }
        ,
        onSelectedStorage(data) {
            this.item.storage = data.storage;
            this.choosing_state = 0;
        }
        ,
        onSelectedNomenclature(data) {
            this.selectingRow.nomenclature = data.nomenclature;
            this.choosing_state = 0;
        }
        ,
        onBack() {
            this.choosing_state = 0;
        }
    }


}
