<template>
    <div>
        <el-row v-if=" choosing_state === 0 ">
            <el-col :span="20" :offset="2">
                <el-card class="box-card">

                    <div slot="header">
                        <h2 class="text-center">Новое поступление товаров</h2>
                    </div>
                    <el-form label-position="left">
                        <el-row>
                            <el-col :span="6">
                                <el-form-item label="Id документа: ">
                                    <el-input readonly v-model="item.id" placeholder="">
                                    </el-input>
                                </el-form-item>

                                <el-form-item label="Дата: ">
                                    <el-date-picker id="name_input" style="width: 100%" v-model="item.date"
                                                    type="datetime"/>
                                </el-form-item>
                            </el-col>
                            <el-col :span="6" :offset="1">
                                <el-form-item label="Контрагент: ">
                                    <el-input readonly v-model="item.agent.name" placeholder="">
                                        <el-button type="primary" @click="selectingAgent" slot="append"
                                                   icon="el-icon-d-arrow-right"></el-button>
                                    </el-input>
                                </el-form-item>
                                <el-form-item label="Склад: ">
                                    <el-input readonly v-model="item.store.name" placeholder="">
                                        <el-button type="primary" @click="selectingStore" slot="append"
                                                   icon="el-icon-d-arrow-right"></el-button>
                                    </el-input>
                                </el-form-item>
                            </el-col>

                            <el-col :span="6" :offset="1">
                            </el-col>
                        </el-row>

                        <el-card style="margin-bottom: 40px">
                            <el-divider content-position="left"><h2>Товары</h2></el-divider>

                            <el-button @click="addToTable" style="margin-bottom: 20px">Добавить</el-button>
                            <el-table :data="item.table_data"
                                      highlight-current-cell
                                      @cell-dblclick="cellEdit"
                                      @current-change="rowSelected"
                                      border
                                      show-summary
                                      sum-text="  "
                            >
                                <el-table-column
                                    prop="table_id"
                                    label="№"
                                    min-width="45"
                                    :index="1"
                                >
                                </el-table-column>
                                <el-table-column
                                    prop="nomenclature.name"
                                    label="Наименование"
                                    min-width="200"
                                    :index="2"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow.table_id === scope.row.table_id" readonly
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
                                >
                                </el-table-column>
                                <el-table-column
                                    prop="nomenclature.characteristic.serial"
                                    label="Серия"
                                    min-width="100"
                                    :index="4"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow.table_id === scope.row.table_id"
                                                  v-model="scope.row.characteristic.serial" placeholder="">

                                        </el-input>
                                        <div v-else> {{ scope.row.characteristic.serial }}</div>
                                    </template>

                                </el-table-column>
                                <el-table-column
                                    prop="nomenclature.characteristic.expiry_date"
                                    label="Срок годности"
                                    min-width="100"
                                    :index="5"
                                >
                                    <template slot-scope="scope">
                                        <el-date-picker v-if="selectingRow.table_id === scope.row.table_id"
                                                        style="width: 100%"
                                                        v-model="scope.row.characteristic.expiry_date"
                                                        format="yyyy/MM/dd"
                                                        value-format="yyyy-MM-dd"/>

                                        <div v-else> {{ scope.row.characteristic.expiry_date }}</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="count"
                                    label="Кол-во"
                                    min-width="100"
                                    :index="6"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow.table_id === scope.row.table_id" type="number"
                                                  v-model="scope.row.count" placeholder="">
                                            <template slot="append">шт.</template>
                                        </el-input>
                                        <div v-else> {{ scope.row.count }} шт.</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="income_price"
                                    label="Цена закупки"
                                    min-width="100"
                                    :index="7"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow.table_id === scope.row.table_id" type="number"
                                                  v-model="scope.row.income_price" placeholder="">
                                            <template slot="append">руб.</template>
                                        </el-input>
                                        <div v-else> {{ scope.row.income_price }} руб.</div>
                                    </template>
                                </el-table-column>
                                <el-table-column
                                    prop="sell_price"
                                    label="Цена продажи"
                                    min-width="100"
                                    :index="7"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow.table_id === scope.row.table_id" type="number"
                                                  v-model="scope.row.sell_price" placeholder="">
                                            <template slot="append">руб.</template>
                                        </el-input>
                                        <div v-else> {{ scope.row.sell_price }} руб.</div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </el-card>

                        <el-form-item>
                            <el-button type="primary" @click="submit">Добавить</el-button>
                            <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                        </el-form-item>

                    </el-form>
                </el-card>


            </el-col>
        </el-row>
        <agent-choose-component @back="onBack" v-if="choosing_state ===1"
                                @selected="onSelectedAgent"></agent-choose-component>
        <agent-choose-component @back="onBack" v-if="choosing_state ===3"
                                @selected="onSelectedStore"></agent-choose-component>
        <nomenclature-choose-component @back="onBack" v-if="choosing_state ===2"
                                       @selected="onSelectedNomenclature"></nomenclature-choose-component>
    </div>
</template>

<script>


import mixin_index from "../../../code/mixins/mixin_index";
import nomenclature from "../../../store/modules/nomenclature";
import IncomeDocument from "../../../code/models/IncomeDocument";
import DocumentTableRow from "../../../code/models/DocumentTableRow";

export default {
    name: "IncomeCreate",

    mixins: [mixin_index],
    data() {
        return {
            //модель, в которой будут находиться данные
            item: new IncomeDocument(),
            //переменная, которая помогает отображать компоненты выбора (например, NomenclatureChoose или ProducerChoose)
            choosing_state: 0,
            //показывает, получены ли данные с сервера - при loaded - false не доступна submit-кнопка
            loaded: true,
            //массив с ошибками
            errors: [],
            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: new DocumentTableRow()
        }
    },

    //ивент, срабатывающий при created стадии компонента - в поле дата закидывает текущую дату
    created() {
        this.item.date = Date.now();
    },

    methods: {
        //метод-заглушка
        update() {},
        //метод добавляет новую пустую строку в массив table_data, и, соответственно в табличную часть формы
        addToTable() {
            //id = -1, table_id используется чтобы нумерация строк происходила с 1 и дальше
            //TODO: при реализации удаления строки из таблицы, переделать нумерацию, чтобы было max_id + 1

            this.item.table_data.push(new DocumentTableRow(-1, this.item.table_data.length + 1));

            //console.log(this.item.table_data)
        },
        //обработчик события cell-dblclick - обрабатывает двойной щелчок по выбраной клетке
        //чисто технически, его можно переделать в rowEdit, но пока не горит
        cellEdit(row, column, cell, event) {
            //присваивает выбранную строку в selectingRow - читать выше
            this.selectingRow = row;
        },
        //сабмит - отправляет данные
        submit: function () {
            //не проходит валидацию - возвращаем
            //if (!this.validateFields()) return;

            //блокируем кнопку submit
            this.loaded = false;

            //пост-запрос
            //отправляет данные, полученные из специально подготовленного метода, чтобы не отправлять лишаки
            axios.post("/api/income", {items: this.item.getDataForServer()}).then((response) => {
                console.log(response.data);
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
             //this.errors = [];
             //if (this.item.agent.id == null) this.errors.push("Поле \"Контрагент\" должно быть заполнено");
             //if (this.item.store.id == null) this.errors.push("Поле \"Склад\" должно быть заполнено");
             //if (!this.item.price_type.id) this.errors.push("Ошибка в поле \"Ценовая группа\"");
             //if (!this.item.producer.id) this.errors.push("Ошибка в поле \"Производитель\"");
             //if (this.item.price_type.id <= 0) this.errors.push("Ошибка в поле \"Ценовая группа\"");
             //if (this.item.producer.id <= 0) this.errors.push("Ошибка в поле \"Производитель\"");
//
//
             //this.showErrors()
//
             //return this.errors.length === 0;
        }
        ,
        selectingStore() {
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
        onSelectedAgent(data) {
            this.item.agent = data.agent;
            this.choosing_state = 0;
        }
        ,
        onSelectedStore(data) {
            this.item.store = data.agent;
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
</script>

<style scoped>

</style>
