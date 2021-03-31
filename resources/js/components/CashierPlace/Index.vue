<template>
    <div>
        <el-row style="width: 100%" v-if=" choosing_state === 0 ">

            <el-col :span="20" :offset="2">


                <el-card class="box-card">
                    <div slot="header">
                        <el-row>

                            <el-col :offset="8" :span="8"><h1
                                v-shortkey="{del: ['del'], f2: ['f2'], change : ['alt', 'q'],change_rus : ['alt', 'й']}"
                                @shortkey="theAction" class="text-center">Рабочее место кассира</h1>
                            </el-col>
                        </el-row>
                    </div>
                    <el-form label-width="100px" label-position="right">

                        <el-card v-if="this.$store.getters.workplace.id != null" style="margin-bottom: 40px">

                            <el-divider content-position="left"><h2>Товары</h2></el-divider>

                            <el-row style="margin-bottom: 10px">
                                <el-button :disabled="this.$store.getters.workplace.active_user_id <= 0"
                                           @click="selectingEntity(2)">Поиск товара [F2]
                                </el-button>
                                <el-button :disabled="rows_sum ===0 " @click="cashInput_dialog = true">Оплата [Alt +
                                    Q]
                                </el-button>

                                <a tag="button" v-if="last_sell_id > 0" class="el-button print_class"
                                   :href="'/report/selling-document/' +last_sell_id+ '/check'">Печать последнего
                                    чека</a>
                                <el-button disabled v-else>
                                    Печать последнего чека
                                </el-button>
                                <router-link class="el-button print_class" :to="{name: 'selling.index'}"
                                >
                                    Пробитые чеки
                                </router-link>
                                <h1 style="float: right">{{ this.status_label }}</h1>
                            </el-row>
                            <el-table :cell-style="{padding: '0', height: '50px'}" :data="item.table_rows"

                                      @row-dblclick="rowEdit"

                                      show-summary
                                      sum-text="  "
                                      highlight-current-row
                                      @current-change="rowHover"
                            >
                                <el-table-column
                                    label="№"
                                    min-width="45"
                                    :index="1"
                                >
                                    <template slot-scope="scope">


                                        <div> {{ item.table_rows.indexOf(scope.row) + 1 }}</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="nomenclature.name"
                                    label="Номенклатура"
                                    min-width="200"
                                    :index="2"
                                    sortable
                                >
                                    <template slot-scope="scope">
                                        <div> {{ scope.row.nomenclature.name }}</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="nomenclature.producer.name"
                                    label="Производитель"
                                    min-width="200"
                                    :index="3"
                                    sortable
                                >
                                </el-table-column>
                                <el-table-column
                                    prop="characteristic.name"
                                    label="Характеристика"
                                    sortable
                                    min-width="200"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow === scope.row" readonly
                                                  v-model="scope.row.characteristic.name" placeholder="">
                                            <el-button type="primary" @click="characteristic_dialog = true;"
                                                       :disabled="scope.row.nomenclature.id === -1" slot="append"
                                                       icon="el-icon-d-arrow-right">
                                            </el-button>
                                        </el-input>
                                        <div v-else> {{ scope.row.characteristic.name }}</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="count"
                                    label="Кол-во"
                                    min-width="100"
                                    :index="6"
                                    sortable
                                >

                                    <template slot-scope="scope">

                                        <el-input :ref="item.table_rows.indexOf(scope.row)"
                                                  v-show="selectingRow === scope.row" type="number"
                                                  v-model="scope.row.count" placeholder="">
                                            <template slot="append">шт.</template>
                                        </el-input>
                                        <div autofocus v-show="selectingRow !== scope.row"> {{ scope.row.count }} шт.
                                        </div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="characteristic.characteristic_price.price"
                                    label="Цена продажи"
                                    min-width="100"
                                    :index="7"
                                    sortable
                                    style="border-right: 10px solid black"
                                >
                                    <template slot-scope="scope">


                                        <div> {{ scope.row.characteristic.characteristic_price.price }} руб.
                                        </div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </el-card>

                    </el-form>

                </el-card>


            </el-col>

            <el-col :offset="1" :span="1">
                <div class="outer">
                    <el-card shadow="always"
                             style="background: #ebeef5; border: 1px solid #a5a6ac;  float: left; width: 370px; height: 500px">
                        <el-row style="height: 100%">
                            <el-col :span="4"><i style="font-size: 30px" class="el-icon-s-tools"></i></el-col>
                            <el-col :span="20">
                                <h2> Рабочее место: </h2>
                                <h4> {{ this.$store.getters.workplace.name }}</h4>
                                <el-divider></el-divider>
                                <h2> Пользователь: </h2>
                                <h4> {{ this.$store.getters["auth/user"].name }}</h4>
                                <el-divider></el-divider>

                                <el-button v-if="this.$store.getters.workplace.active_user_id > 0 " type="primary" plain
                                           @click="closeWorkplace" style="width: 100%">Закрыть смену
                                </el-button>

                                <div v-else>
                                    <el-button @click="openWorkplace" type="primary" plain style="width: 100%">Открыть
                                        смену
                                    </el-button>
                                    <el-button type="primary" plain
                                               style="margin-left: 0; margin-top: 15px; width: 100%"
                                               @click="quitWorkplace">Выйти из рабочего
                                        места
                                    </el-button>
                                </div>
                            </el-col>
                        </el-row>
                    </el-card>
                </div>
            </el-col>
        </el-row>
        <MedicamentSearch @back="onBack" v-if="choosing_state === 2"
                          :storage_id="this.$store.getters.workplace.storage.id"
                          @selected="onSelectedNomenclatureForCashier"></MedicamentSearch>
        <el-drawer

            :visible.sync="characteristic_dialog"
            direction="ltr"
            custom-class="demo-drawer"
            ref="drawer"
            size="50%"
        >
            <characteristic-choose-component @back="onBack" v-if="characteristic_dialog"
                                             :nomenclature_id="selectingRow.nomenclature.id"
                                             @selected="onSelectedCharacteristic"></characteristic-choose-component>
        </el-drawer>

        <el-dialog :visible.sync="cashInput_dialog" style="width: 1000px; margin: 0 auto">
            <CashInput @selected="changeSelected" :check_sum="rows_sum"></CashInput>
        </el-dialog>

        <config-board @selected="choosing_state = 0;" v-if="choosing_state === 4">

        </config-board>

        <div v-if="choosing_state ===5">
            <el-card class="center-75">
                <CharacteristicSearch style="margin-bottom: 30px" @back="characteristic_back"
                                      @selected="characteristic_selected" :nomenclature_id="barcode_nomenclature.id"
                                      :storage_id="this.$store.getters.workplace.storage.id">

                </CharacteristicSearch>
            </el-card>
        </div>

    </div>
</template>

<script>


import FinanceDocument from "../../code/models/FinanceDocument";
import MedicamentSearch from "./MedicamentSearch";
import CashInput from "./CashInput";
import FinanceDocumentTableRow from "../../code/models/FinanceDocumentTableRow";

export default {
    name: "CashierIndex",
    components: {CashInput, MedicamentSearch},
    data() {
        return {

            barcode_nomenclature: null,
            //массив с ошибками
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
            //строка, по которой кликнули всего один раз - используется при удалении и отображении
            hover_row: null,
            //булево значение диалогового окна выбора характеристики уже созданной строки
            characteristic_dialog: false,
            //булево значение диалогового окна ввода наличных
            cashInput_dialog: false,
            //поле для сдачи
            change: 0,
            last_sell_id: 0
        }
    },
    //ивент, срабатывающий при created стадии компонента - в поле дата закидывает текущую дату
    created() {
        this.item.date = Date.now();

        if (this.$store.getters.workplace === null) this.choosing_state = 4;

        this.$barcodeScanner.init(this.onBarcodeScanned)
    },
    computed: {

        //Вычисляемое поле - отображает либо сумму чека, либо сдачу (если оплата уже была произведена)
        status_label: function () {
            if (this.rows_sum === 0 && this.change > 0) return `Сдача: ${this.change}`
            return `Сумма: ${this.rows_sum}`
        },
        //сумма документа - выводится в status_label
        rows_sum: function () {
            let sum = 0;
            this.item.table_rows.forEach(p => {
                sum += p.count * p.characteristic.characteristic_price.price
            });
            return sum;
        }
    },
    methods: {
        characteristic_selected(data) {
            this.choosing_state = 0;
            let new_row = new FinanceDocumentTableRow();
            new_row.nomenclature = this.barcode_nomenclature;
            new_row.characteristic = data.characteristic;
            new_row.count = 1;
            this.item.table_rows.push(new_row);

        },
        characteristic_back() {
            this.choosing_state = 0;
        },

        // Create callback function to receive barcode when the scanner is already done
        onBarcodeScanned(barcode) {
            console.log(barcode)

            axios.post("/api/barcodes/findNomenclatureByBarcode", {barcode: barcode}).then((response) => {

                console.log(response.data)
                if (response.data.nomenclature !== null) {
                    this.barcode_nomenclature = response.data.nomenclature;
                    this.choosing_state = 5;
                } else {
                    this.$notify.error({
                        title: 'Ошибка!',
                        message: `Номенклатуры со штрихкодом ${barcode} не найдено`,
                    })
                }


            });


        },
        // Reset to the last barcode before hitting enter (whatever anything in the input box)
        resetBarcode() {
            let barcode = this.$barcodeScanner.getPreviousCode()

        },
        //показывает ошибки
        showErrors() {
            this.errors.forEach(item => this.$notify.error({
                title: 'Ошибка!',
                message: item,
            }));
        },
        //обработчик события row-dblclick - обрабатывает двойной щелчок по выбраной строке
        rowEdit(row) {
            //присваивает выбранную строку в selectingRow
            this.selectingRow = row;
        },
        //обработчик события row-dblclick - обрабатывает одиночный щелчок по выбраной строке
        rowHover(item) {
            this.hover_row = item;
            //убирает строку, по которой был dbl-click, потому что фокус сместился на другую строку
            this.selectingRow = null;
        },
        //удаление строки табличной части
        deleteSelected() {

            //если не выбрана ни одна строка - ничего не делаем
            if (this.hover_row == null) return;

            //удаляем строку из табличной части
            let index = this.item.table_rows.indexOf(this.hover_row);

            this.item.table_rows.splice(index, 1);

            this.hover_row = null

        },
        //меняет choosing_state, выводя другие компоненты
        //state - число, отображающее компоненту
        selectingEntity(state) {
            this.choosing_state = state;
        },

        onSelectedCharacteristic(data) {
            let flag = true;
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
        selectingWorkPlace() {
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
        },
        quitWorkplace() {

            this.$store.dispatch("deleteWorkplace");
            this.choosing_state = 4;
        },
        theAction(event) {
            console.log(event)
            switch (event.srcKey) {
                case 'del':
                    this.deleteSelected();
                    break;
                case 'f2':
                    if (this.$store.getters.workplace.active_user_id > 0)
                        this.selectingEntity(2);
                    break;
                case 'change':
                case 'change_rus':
                    if (this.rows_sum > 0)
                        this.cashInput_dialog = true;
                    break;
            }
        },
        validateFields() {
            this.errors = [];
            if (this.item.agent.id === 1) this.errors.push("Поле \"Поставщик\" должно быть заполнено");
            if (this.item.storage.id === -1) this.errors.push("Поле \"Склад\" должно быть заполнено");

            this.item.table_rows.forEach(p => {
                if (p.nomenclature.id === -1) this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Номенклатура\" должно быть заполнено`);
                if (p.characteristic.serial === "") this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Серия\" должно быть заполнено`);
                if (p.characteristic.expiry_date === "") this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Срок годности\" должно быть заполнено`);
                if (p.income_price <= 0) this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Цена поступления\" должно быть больше 0`);
                //if (p.sell_price <= 0) this.errors.push(`Строка № ${this.item.table_rows.indexOfp}. Поле \"Цена продажи\" должно быть больше 0`);
                if (p.count <= 0) this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Количество\" должно быть больше 0`);
            })
            this.showErrors()

            return this.errors.length === 0;
        },

        changeSelected(data) {

            axios.post('/api/cashier/send', {
                items: this.item.getDataForCashier(),
                doc_sum: this.rows_sum,
                workplace_id: this.$store.getters.workplace.id,
                user_id: this.$store.getters["auth/user"].id
            }).then((response) => {

                this.change = data.change;
                this.cashInput_dialog = false;
                this.item.table_rows = [];
                this.selectingRow = null;
                this.last_sell_id = response.data.sell_id;

                this.$message({
                    showClose: true,
                    message: `Кассовый чек с Id=${this.last_sell_id} успешно создан!`,
                    type: 'success'
                });


            }).catch(error => {
                console.log("Произошла ошибка! " + error.message)
            })
        },

        openWorkplace() {
            axios.post("/api/cashier/open", {
                user_id: this.$store.getters["auth/user"].id,
                workplace_id: this.$store.getters.workplace.id

            }).then((response) => {
                    this.$store.dispatch("setWorkplace", response.data);
                    this.$notify({
                        type: 'success',
                        title: 'Открыто!',
                        message: `Смена была успешно открыта!`,
                    })
                }
            )
        },
        closeWorkplace() {
            axios.post("/api/cashier/close", {

                user_id: this.$store.getters["auth/user"].id,
                workplace_id: this.$store.getters.workplace.id

            }).then((response) => {
                    this.$store.dispatch("setWorkplace", response.data)
                    this.$notify({
                        type: 'success',
                        title: 'Закрыто!',
                        message: `Смена была успешно закрыта!`,
                    })
                }
            )
        }

    }
}
</script>

<style scoped>
.outer {
    overflow: hidden;
    position: fixed;


    transition: .2s;
}

.outer:hover {
    transform: translateX(-300px)

}

.inner {


}
</style>
