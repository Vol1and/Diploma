//данный код будет включен во все Document-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
import StorageDocument from "../models/StorageDocument";
import StorageDocumentTableRow from "../models/StorageDocumentTableRow";

export default {


    data: function () {
        return {
            characteristic_dialog: false,
            errors: [],
            //переменная, которая помогает отображать компоненты выбора (например, NomenclatureChoose или ProducerChoose)
            choosing_state: 0,
            //показывает, получены ли данные с сервера - при loaded - false не доступна submit-кнопка
            loaded: true,
            //модель, в которой будут находиться данные
            item: new StorageDocument(null, 3),
            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: new StorageDocumentTableRow(null),
            hover_row: null,
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
            if (this.selectingRow.isEqual(item)) return;

            this.selectingRow = new StorageDocumentTableRow();
        },
        //удаление строки табличной части
        deleteSelected() {



            this.selectingRow = new StorageDocumentTableRow();
            //если не выбрана ни одна строка - ничего не делаем
            if (this.hover_row == null) return;

            //удаляем строку из табличной части
            let index = this.item.table_rows.indexOf(this.hover_row);
            this.item.table_rows.splice(index, 1);

            //если удалена новая строка и она не сохранена на сервере - не заносим в deleted_rows
            if (this.hover_row.id == null) return;

            //вносим данные в deleted_rows
            this.item.deleted_rows.push(this.hover_row.id);

        },
        //метод добавляет новую пустую строку в массив table_rows, и, соответственно в табличную часть формы
        addToTable() {
            this.item.table_rows.push(new StorageDocumentTableRow(null));
        },
        selectingSourceStorage() {
            this.choosing_state = 3;
        },
        selectingDestinationStorage() {
            this.choosing_state = 4;
        },
        selectingAgent() {
            this.choosing_state = 1;
        },
        selectingNomenclature(row) {
            this.choosing_state = 2;
            this.buffer_row = this.selectingRow;
        },
        selectingCharacteristic() {
            this.choosing_state = 4;
        },
        onSelectedCharacteristic(data) {
            let flag = true;
            this.item.table_rows.forEach(p => {
                if (p.characteristic.id === data.characteristic.id) {
                    //удаляем строку из табличной части
                    //удаляем строку из табличной части
                    let index = this.item.table_rows.indexOf(this.hover_row);
                    this.item.table_rows.splice(index, 1);
                    //если удалена новая строка и она не сохранена на сервере - не заносим в deleted_rows
                    if (this.hover_row.id != null) this.item.deleted_rows.push(this.hover_row.id);

                    this.hover_row = p;
                    this.selectingRow = p;
                    flag = false;
                    this.$notify.error({
                        title: 'Ошибка!',
                        message: "Строка с такой номенклатурой уже присутствует в таблице!"
                    });
                }
            })
            if (flag) this.selectingRow.characteristic = data.characteristic;
            this.choosing_state = 0;
            this.characteristic_dialog = false;
        },

        onSelectedSourceStorage(data) {
            this.choosing_state = 0;
            if (this.item.type === 2 && this.item.table_rows.length > 0) {
                this.$notify.error({
                    title: 'Ошибка!',
                    message: "Очистите табличную часть перед изменением склада",
                })
            } else this.item.source_storage = data.storage;

        },
        onSelectedDestinationStorage(data) {
            this.choosing_state = 0;
            this.item.destination_storage = data.storage;

        },
        onSelectedNomenclature(data) {
            this.selectingRow.nomenclature = data.nomenclature;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        },

    }
}
/*
*
* onSelectedNomenclature(data) {
            if(this.buffer_row != null) {

            }
            let row = new StorageDocumentTableRow();
            row.nomenclature = data.nomenclature;
            row.characteristic = data.nomenclature.characteristic;

            this.item.table_rows.push(row);
            this.choosing_state = 0;
        }
* */
