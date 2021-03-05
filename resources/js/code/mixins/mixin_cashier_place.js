//данный код будет включен во все Document-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
import FinanceDocument from "../models/FinanceDocument";
import FinanceDocumentTableRow from "../models/FinanceDocumentTableRow";
import WorkPlace from "../models/WorkPlace";

export default {


    data: function () {
        return {
            workplace : new WorkPlace(null),
            characteristic_dialog: false,
            errors: [],
            //переменная, которая помогает отображать компоненты выбора (например, NomenclatureChoose или ProducerChoose)
            choosing_state: 0,
            //показывает, получены ли данные с сервера - при loaded - false не доступна submit-кнопка
            loaded: true,
            //модель, в которой будут находиться данные
            item: new FinanceDocument(null, 1),
            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: null,
            hover_row: null,
            buffer_row: null
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
            //let id = this.item.table_rows.indexOf(row)
            //console.log(id)
            //if(this.$refs[id] !== null)this.$refs[id].focus();
        }
        ,
        rowHover(item) {

            if (item == null ) {
                this.hover_row = null;
                return;
            }
            //if (this.selectingRow.isEqual(item)) return;
            this.hover_row = item;
            this.selectingRow = null;
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

            this.hover_row = null

        },
        //метод добавляет новую пустую строку в массив table_rows, и, соответственно в табличную часть формы
        //addToTable() {
        //    this.item.table_rows.push(new FinanceDocumentTableRow(null));
        //},
        selectingStorage() {
            this.choosing_state = 3;
        },
        selectingNomenclature(row) {
            this.choosing_state = 2;

        },
        selectingCharacteristic() {
            this.choosing_state = 4;
        },
        onSelectedCharacteristic(data) {
            let flag = true;
            this.item.table_rows.forEach
            this.item.table_rows.forEach(p => {
                if (p.characteristic.id === data.characteristic.id) {
                    //удаляем строку из табличной части
                    let index = this.item.table_rows.indexOf(this.hover_row);
                    this.item.table_rows.splice(index, 1);

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
        onSelectedStorage(data) {
            this.choosing_state = 0;
            if (this.item.type === 2 && this.item.table_rows.length > 0) {
                this.$notify.error({
                    title: 'Ошибка!',
                    message: "Очистите табличную часть перед изменением склада",
                })
            } else this.item.storage = data.storage;

        },
        onSelectedNomenclature(data) {
            this.selectingRow.nomenclature = data.nomenclature;
            this.choosing_state = 0;
        },
        selectingWorkPlace(){
            this.choosing_state = 3;
        },
        onSelectedWorkPlace(data) {
            this.workplace = data.workplace;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        },
        onSelectedNomenclatureForCashier(data) {


            let row = new FinanceDocumentTableRow();
            row.nomenclature = data.nomenclature;
            row.characteristic = data.nomenclature.characteristic;
            row.count += 1;
            this.item.table_rows.push(row);
            this.rowEdit(row);

            this.choosing_state = 0;
        }
    }
}
/*
*
* onSelectedNomenclature(data) {
            if(this.buffer_row != null) {

            }
            let row = new FinanceDocumentTableRow();
            row.nomenclature = data.nomenclature;
            row.characteristic = data.nomenclature.characteristic;

            this.item.table_rows.push(row);
            this.choosing_state = 0;
        }
* */
