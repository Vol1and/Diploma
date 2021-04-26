//данный код будет включен во все Document-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
import StorageDocument from "../models/StorageDocument";
import StorageDocumentTableRow from "../models/StorageDocumentTableRow";
import mixin_base_document from "./mixin_base_document";

export default {

    mixins: [mixin_base_document],


    data: function () {
        return {
            //модель, в которой будут находиться данные
            item: new StorageDocument(null, 3),
            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: new StorageDocumentTableRow(null),
        };
    },

    methods: {

        //метод добавляет новую пустую строку в массив table_rows, и, соответственно в табличную часть формы
        addToTable() {
            this.item.table_rows.push(new StorageDocumentTableRow(null));
        },
        //метод выбора основного склада (склада-отправителя для перемещений и склада, с которого списывается товар в списании)
        selectingSourceStorage() {
            this.choosing_state = 3;
        },
        //метод выбора склада получателя для перемещений
        selectingDestinationStorage() {
            this.choosing_state = 4;
        },
        //метод выбранного основного склада
        onSelectedSourceStorage(data) {
            this.choosing_state = 0;
            //если расход  и табличная часть не пуста - запрещаем изменять склад
            if (this.item.type === 2 && this.item.table_rows.length > 0) {
                this.$notify.error({
                    title: 'Ошибка!',
                    message: "Очистите табличную часть перед изменением склада",
                })
            } else this.item.source_storage = data.storage;

        },
        //метод выбранного склада-получателя в перемещении
        onSelectedDestinationStorage(data) {
            this.choosing_state = 0;
            this.item.destination_storage = data.storage;

        },
        //метод работы сканера штрих-кодов
        onBarcodeScanned(barcode) {
            //если не выбран основной склад - не выполняем
            if (this.item.source_storage.id != null) {
                //пост-запрос - ищет номенклатуру по штрихкоду
                axios.post("/api/barcodes/findNomenclatureByBarcode", {barcode: barcode}).then((response) => {
                    //проверка на пришедшую номенклатуру
                    if (response.data.nomenclature !== null) {
                        //если все ок - создаем новую строку
                        let row = new StorageDocumentTableRow(null);
                        //помещаем в новую строку пришедшую номенклатуру
                        row.nomenclature = response.data.nomenclature;
                        //помещаем новую строку в табличную часть документа
                        this.item.table_rows.push(row);
                        //ставим редактирование на данную строку
                        this.selectingRow =  this.buffer_row  = row;
                        //переходим к окну характеристики по данной номенклатуре
                        this.selectingCharacteristic();
                    } else {
                        this.$notify.error({
                            title: 'Ошибка!',
                            message: `Номенклатуры со штрихкодом ${barcode} не найдено`,
                        })
                    }
                });
            }
            else {
                this.$notify.error({
                    title: 'Ошибка!',
                    message: `Сначала выберите склад! `,
                })
            }
        },
    }
}
