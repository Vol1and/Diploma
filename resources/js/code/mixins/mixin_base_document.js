import FinanceDocumentTableRow from "../models/FinanceDocumentTableRow";
import Characteristic from "../models/Characteristic";
//базовая примесь, которую наследуют оба вида документов
export default {




    data: function () {
        return {
            characteristic_dialog: false,
            errors: [],
            //переменная, которая помогает отображать компоненты выбора (например, NomenclatureChoose или ProducerChoose)
            choosing_state: 0,
            //показывает, получены ли данные с сервера - при loaded - false не доступна submit-кнопка
            loaded: true,
            //переменная, в которую попадает строка, на которую один раз кликнули
            //используется, чтобы снять метку редактирования с другой строки при изменении фокуса
            hover_row: null,
            //буферное поле - используется в некоторых случаях для корректного изменения полей строки
            buffer_row: null
        };
    },

    methods: {

        //отображение ошибок
        showErrors() {
            this.errors.forEach(item =>
                this.$message({
                    showClose: true,
                    message: item,
                    type: 'error'
                }));
        },
        //обработчик события row-dblclick - обрабатывает двойной щелчок по выбраной строке
        rowEdit(row) {
            //присваивает выбранную строку в selectingRow - читать выше
            this.selectingRow = row;
        },
        //метод отрбатывает при единичном клике по строке
        rowHover(item) {
            // hover_row присваевается новая строка
            this.hover_row = item;
            //если выбранная строка не равна редактируемой строке - редактируемая строка пропадает
            if (!this.selectingRow.isEqual(item)) this.selectingRow = new FinanceDocumentTableRow(null);
        },
        //удаление строки табличной части
        deleteSelected() {
            this.selectingRow = new FinanceDocumentTableRow();
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
        //метод для выбора номенклатуры
        selectingNomenclature() {
            this.choosing_state = 2;
        },
        //метод для выбора характеристики
        selectingCharacteristic() {
            this.characteristic_dialog = true;
            //в buffer_row попадает текущая выбранная строка
            this.buffer_row = this.selectingRow;
        },
        //метод выбранной характеристики
        onSelectedCharacteristic(data) {
            //флаг - все ли хорошо
            let flag = true;
            //в выбранную строку присваивается buffer_row - иначе (скорее всего, благодаря реактивности) выбранная строка слетает
            this.selectingRow = this.buffer_row;
            //цикл по всем строкам таблици
            this.item.table_rows.forEach(p => {
                //если такая характеристика уже ест
                if (p.characteristic.id === data.characteristic.id) {
                    //берем индекс hover_row
                    let index = this.item.table_rows.indexOf(this.hover_row);
                    //удаляем эту строку
                    this.item.table_rows.splice(index, 1);
                    //редактирование переносится на строку с той же характеристикой
                    this.hover_row =  this.selectingRow = p;
                    //флаг - убираем
                    flag = false;
                    //выводим ошибку
                    this.$notify.error({
                        title: 'Ошибка!',
                        message: "Строка с такой номенклатурой уже присутствует в таблице!"
                    });
                }
            })

            if (flag) this.selectingRow.characteristic = data.characteristic;
            //возвращаемся к окну документа
            this.choosing_state = 0;
            //диалоговое окно закрывыается
            this.characteristic_dialog = false;
        },
        //метод выбранной номенклатуры
        onSelectedNomenclature(data) {
            // в редактируемую строку вставляется выбранная номенклатура
            this.selectingRow.nomenclature = data.nomenclature;
            //также создается новая характеристика
            this.selectingRow.characteristic = new Characteristic(null);
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        }
    }
}
