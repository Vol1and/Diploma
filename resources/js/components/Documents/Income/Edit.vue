<template>
    <div>

        <el-row v-if=" choosing_state === 0 ">

            <el-col :span="20" :offset="2">
                <el-card class="box-card">
                    <div slot="header">
                        <h2 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Поступление #{{
                                item.id
                            }}</h2>
                    </div>
                    <el-form label-width="100px" label-position="right">

                        <div style="margin-bottom: 30px">
                            <el-button v-if="!item.is_set" type="primary" @click="submit(true)"><i class="el-icon-finished"></i> Провести
                            </el-button>
                            <el-button v-else type="primary" disabled ><i class="el-icon-finished"></i> Уже проведен
                            </el-button>

                            <el-button @click="submit(false)"  v-if="!item.is_set"><i class="el-icon-folder-checked"></i> Записать
                            </el-button>


                            <el-dropdown>
                                <el-button>
                                    Печать<i class="el-icon-arrow-down el-icon--right"></i>
                                </el-button>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item><a  class="print_class" :href="'/report/income-document/' +item.id+ '/1'" >Общий отчет</a></el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>


                            <el-button style="float: right" type="error" @click="()=>{this.$router.go(-1)}"><i
                                class="el-icon-close"> Выход </i></el-button>
                        </div>


                        <el-row>
                            <el-col :span="4">
                                <el-form-item label="Id документа: ">
                                    <el-input readonly v-model="item.id" placeholder="">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="5">

                                <el-form-item label="Дата: ">
                                    <el-date-picker id="name_input" style="width: 100%" v-model="item.date"
                                                    type="datetime" format="yyyy-MM-dd HH:mm:ss"
                                                    value-format="yyyy-MM-dd HH:mm:ss"/>
                                </el-form-item>
                            </el-col>

                            <el-col :span="5">
                                <el-form-item label="Поставщик: ">
                                    <el-input readonly v-model="item.agent.name" placeholder="">
                                        <el-button type="primary" @click="selectingAgent" slot="append"
                                                   icon="el-icon-d-arrow-right"></el-button>
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="5">
                                <el-form-item label="Склад: ">
                                    <el-input readonly v-model="item.storage.name" placeholder="">
                                        <el-button type="primary" @click="selectingStorage" slot="append"
                                                   icon="el-icon-d-arrow-right"></el-button>
                                    </el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>


                        <el-card style="margin-bottom: 40px">
                            <el-divider content-position="left"><h2>Товары</h2></el-divider>

                            <el-row style="margin-bottom: 10px">
                                <el-tooltip class="item" effect="light" content="Добавить новую строку" placement="top">
                                    <el-button @click="addToTable" circle icon="el-icon-plus"></el-button>
                                </el-tooltip>
                                <el-tooltip class="item" effect="light" content="Удалить выбранную строку"
                                            placement="top">
                                    <el-button @click="deleteSelected" circle icon="el-icon-delete-solid"></el-button>
                                </el-tooltip>
                            </el-row>
                            <el-table :cell-style="{padding: '0', height: '50px'}" :data="item.table_rows"
                                      highlight-current-cell
                                      @row-dblclick="rowEdit"
                                      border
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

                                        <el-input v-if="selectingRow === scope.row" readonly
                                                  v-model="scope.row.nomenclature.name" placeholder="">
                                            <el-button type="primary" @click="selectingNomenclature" slot="append"
                                                       icon="el-icon-d-arrow-right">
                                            </el-button>
                                        </el-input>
                                        <div v-else> {{ scope.row.nomenclature.name }}</div>
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
                                    prop="nomenclature.characteristic.name"
                                    label="Характеристика"
                                    min-width="150"
                                    sortable
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow === scope.row" readonly
                                                  v-model="scope.row.characteristic.name" placeholder="">
                                            <el-button type="primary" :disabled="scope.row.nomenclature.id === -1" @click="selectingCharacteristic"  slot="append"
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

                                        <el-input v-if="selectingRow === scope.row" type="number"
                                                  v-model="scope.row.count" placeholder="">
                                        </el-input>
                                        <div v-else> {{ scope.row.count }} шт.</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="income_price"
                                    label="Цена закупки"
                                    min-width="100"
                                    :index="7"
                                    sortable
                                >
                                    <template slot-scope="scope">

                                        <div style="padding: 0">
                                            <el-input v-if="selectingRow === scope.row" type="number"
                                                      v-model="scope.row.income_price" placeholder="">
                                            </el-input>
                                            <div v-else> {{ scope.row.income_price }} руб.</div>
                                        </div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    label="Сумма"
                                    min-width="100"
                                    :index="7"
                                    sortable
                                >
                                    <template slot-scope="scope">
                                        {{  scope.row.income_price * scope.row.count}} руб.
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="characteristic.characteristic_price.price"
                                    label="Цена продажи"
                                    min-width="100"
                                    :index="7"
                                    sortable
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow === scope.row" type="number"
                                                  v-model="scope.row.characteristic.characteristic_price.price"
                                                  placeholder="">
                                        </el-input>
                                        <div v-else> {{ scope.row.characteristic.characteristic_price.price }} руб.
                                        </div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </el-card>
                    </el-form>

                    <el-divider content-position="left"><h4>Комментарий</h4></el-divider>
                    <el-input type="textarea"
                              :rows="3"
                              placeholder="Комментарий"
                              v-model="item.comment"
                    ></el-input>
                </el-card>


            </el-col>

        </el-row>
        <el-drawer
            size="50%"
            :visible.sync="characteristic_dialog"
            direction="ltr"
            custom-class="demo-drawer"
            ref="drawer"
        >
            <characteristic-choose-component @back="onBack" v-if="characteristic_dialog"
                                                        :nomenclature_id="buffer_row.nomenclature.id"
                                                        @selected="onSelectedCharacteristic"></characteristic-choose-component>
        </el-drawer>
        <agent-choose-component @back="onBack" v-if="choosing_state ===1"
                                @selected="onSelectedAgent"></agent-choose-component>
        <storage-choose-component @back="onBack" v-if="choosing_state ===3"
                                  @selected="onSelectedStorage"></storage-choose-component>

        <nomenclature-choose-component @back="onBack" v-if="choosing_state ===2"
                                       @selected="onSelectedNomenclature"></nomenclature-choose-component>

    </div>
</template>

<script>


import FinanceDocument from "../../../code/models/FinanceDocument";
import FinanceDocumentTableRow from "../../../code/models/FinanceDocumentTableRow";
import Agent from "../../../code/models/Agent";
import Storage from "../../../code/models/Storage";
import Nomenclature from "../../../code/models/Nomenclature";
import Producer from "../../../code/models/Producer";
import Characteristic from "../../../code/models/Characteristic";
import CharacteristicPrice from "../../../code/models/CharacteristicPrice";
import mixin_finance_document from "../../../code/mixins/mixin_finance_document";

export default {
    name: "IncomeEdit",

    mixins: [mixin_finance_document],
    data() {
        return {

        }
    },
    created() {

        this.update()

        this.$barcodeScanner.init(this.onBarcodeScanned)
    },
    destroyed() {
        // Remove listener when component is destroyed
        this.$barcodeScanner.destroy()
    },
    methods: {

        // Create callback function to receive barcode when the scanner is already done
        onBarcodeScanned(barcode) {
            console.log(barcode)

            axios.post("/api/barcodes/findNomenclatureByBarcode", {barcode: barcode}).then((response) => {

                console.log(response.data)
                if (response.data.nomenclature !== null) {
                    let row = new FinanceDocumentTableRow(null);
                    row.nomenclature = response.data.nomenclature;
                    //this.barcode_nomenclature = response.data.nomenclature;


                    this.item.table_rows.push(row);
                    this.selectingRow = row;
                    this.selectingCharacteristic();
                } else {
                    this.$notify.error({
                        title: 'Ошибка!',
                        message: `Номенклатуры со штрихкодом ${barcode} не найдено`,
                    })
                }
            });
        },
        update() {
            axios.get(`/api/finance-documents/${this.$route.params.id}`).then(response => {
                    console.log(response)
                    this.is_visible = true;
                    let table_data = [];
                    if (response.data.table_rows !== undefined && response.data.table_rows.length > 0) response.data.table_rows.forEach(row => table_data.push(
                        new FinanceDocumentTableRow(row.id,

                            new Nomenclature(row.nomenclature.id,
                                row.nomenclature.name,
                                new Producer(row.nomenclature.producer.id, row.nomenclature.producer.name, row.nomenclature.producer.country),
                            ),
                            new Characteristic(
                                row.characteristic.id,
                                row.characteristic.name,
                                row.characteristic.serial,
                                row.characteristic.expiry_date,
                                new CharacteristicPrice(row.characteristic.characteristic_price.id, row.characteristic.characteristic_price.price)
                            ),
                            row.count,
                            row.price,
                        )));

                    this.item = new FinanceDocument(response.data.id, 1,response.data.is_set,
                        new Agent(response.data.agent.id, response.data.agent.name, response.data.agent.billing, response.data.agent.address, response.data.agent.description, response.data.agent.created_at, response.data.agent.updated_at, response.data.agent.deleted_at),
                        new Storage(response.data.storage.id, response.data.storage.name, response.data.agent.created_at, response.data.agent.updated_at, response.data.agent.deleted_at),
                        response.data.date,
                        table_data,
                        null,
                        response.data.comment,
                        response.data.created_at,
                        response.data.updated_at,
                        response.data.deleted_at);

                    console.log(this.item)

                }
            ).catch((error) => {
                console.log(error);
                ///this.$router.push({name: 'income.index'});
            })
        },
        //сабмит - отправляет данные
        submit: function (state) {
            //не проходит валидацию - возвращаем
            if (!this.validateFields()) return;


            //блокируем кнопку submit
            this.loaded = false;


            //пост-запрос
            //отправляет данные, полученные из специально подготовленного метода, чтобы не отправлять лишаки
            console.log(this.item.getDataForUpdate());

            axios.post(`/api/income/${this.item.id}`, {
                item: this.item.getDataForUpdate(),
                state: state
            }).then((response) => {
                this.selectingRow = new FinanceDocumentTableRow(null);
                console.log(response.data);
                this.update();
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Поступление с Id = ${this.item.id} успешно изменено!`,
                })
            }).catch((error) => {
                //ошибка - выводим
                this.$notify.error({

                    title: 'Ошибка!',
                    message: "Сообщение ошибки - " + error.response.data.message,
                })
                this.loaded = true;
            })
        }
        ,
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
        }
    }

}
</script>

<style scoped>

</style>
