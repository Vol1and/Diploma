//данный код будет включен во все Document-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
import FinanceDocument from "../models/FinanceDocument";
import FinanceDocumentTableRow from "../models/FinanceDocumentTableRow";
import mixin_base_document from "./mixin_base_document";

export default {

    mixins: [mixin_base_document],

    data: function () {
        return {
            //модель, в которой будут находиться данные
            item: new FinanceDocument(null, 1),
            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: new FinanceDocumentTableRow(null),
        };
    },

    methods: {

        //метод добавляет новую пустую строку в массив table_rows, и, соответственно в табличную часть формы
        addToTable() {
            this.item.table_rows.push(new FinanceDocumentTableRow(null));
        },
        //метод для выбора склада
        selectingStorage() {
            this.choosing_state = 3;
        },
        //метод для выбора контрагента
        selectingAgent() {
            this.choosing_state = 1;
        },
        //метод для выбора номенклатуры
        selectingNomenclature() {
            this.choosing_state = 2;
        },
        //метод выбранного контрагента
        onSelectedAgent(data) {
            this.item.agent = data.agent;
            this.choosing_state = 0;
        },
        //метод выбранного склада
        onSelectedStorage(data) {
            this.choosing_state = 0;
            //если расход  и табличная часть не пуста - запрещаем изменять склад
            if (this.item.type === 2 && this.item.table_rows.length > 0) {
                this.$notify.error({
                    title: 'Ошибка!',
                    message: "Очистите табличную часть перед изменением склада",
                })
            } else this.item.storage = data.storage;

        },
        onBack() {
            this.choosing_state = 0;
        }
    }
}
