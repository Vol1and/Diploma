<template>
    <div>
        <el-row v-if=" choosing_state === 0 ">

            <el-col :span="20" :offset="2">
                <el-card class="box-card">
                    <div slot="header">
                        <h2 class="text-center">Новое поступление товаров</h2>
                    </div>
                    <el-form label-width="100px" label-position="right">


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
                                                    type="datetime" format="yyyy-MM-dd HH:mm:ss" />
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

                            <el-button @click="addToTable" style="margin-bottom: 20px">Добавить</el-button>
                            <el-table :data="item.table_rows"
                                      highlight-current-cell
                                      @cell-dblclick="cellEdit"
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
                                                        value-format="yyyy/MM/dd"/>

                                        <div v-else> {{ scope.row.characteristic.expiry_date  }}</div>
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
                                    prop="characteristic.characteristic_price.price"
                                    label="Цена продажи"
                                    min-width="100"
                                    :index="7"
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow.table_id === scope.row.table_id" type="number"
                                                  v-model="scope.row.characteristic.characteristic_price.price" placeholder="">
                                            <template slot="append">руб.</template>
                                        </el-input>
                                        <div v-else> {{ scope.row.characteristic.characteristic_price.price }} руб.</div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </el-card>


                        <el-button type="primary" @click="submit">Добавить</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>

                    </el-form>

                </el-card>


            </el-col>

        </el-row>
        <agent-choose-component @back="onBack" v-if="choosing_state ===1"
                                @selected="onSelectedAgent"></agent-choose-component>
        <storage-choose-component @back="onBack" v-if="choosing_state ===3"
                                  @selected="onSelectedStorage"></storage-choose-component>
        <nomenclature-choose-component @back="onBack" v-if="choosing_state ===2"
                                       @selected="onSelectedNomenclature"></nomenclature-choose-component>
    </div>
</template>

<script>


import IncomeDocument from "../../../code/models/IncomeDocument";
import FinanceDocumentTableRow from "../../../code/models/FinanceDocumentTableRow";
import mixin_create from "../../../code/mixins/mixin_create";

export default {
    name: "IncomeCreate",

    mixins: [mixin_create],
    data() {
        return {
            //модель, в которой будут находиться данные
            item: new IncomeDocument(null),
            //переменная, которая помогает отображать компоненты выбора (например, NomenclatureChoose или ProducerChoose)
            choosing_state: 0,
            //показывает, получены ли данные с сервера - при loaded - false не доступна submit-кнопка
            loaded: true,
            //выбранная строка - в табличной части идет проверка - id_строки - id_selectingRow
            //если true, то строка переходит в editable
            selectingRow: new FinanceDocumentTableRow()
        }
    },

    //ивент, срабатывающий при created стадии компонента - в поле дата закидывает текущую дату
    created() {
        this.item.date = Date.now();
    },

    methods: {
        //метод-заглушка
        update() {
        },
        //метод добавляет новую пустую строку в массив table_rows, и, соответственно в табличную часть формы
        addToTable() {
            //id = -1, table_id используется чтобы нумерация строк происходила с 1 и дальше
            //TODO: при реализации удаления строки из таблицы, переделать нумерацию, чтобы было max_id + 1

            this.item.table_rows.push(new FinanceDocumentTableRow(null, this.item.table_rows.length + 1));

            //console.log(this.item.table_rows)
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
            if (!this.validateFields()) return;

            //блокируем кнопку submit
            this.loaded = false;

            //пост-запрос
            //отправляет данные, полученные из специально подготовленного метода, чтобы не отправлять лишаки
            axios.post("/api/income", {item: this.item.getDataForServer()}).then((response) => {
                console.log(response.data);
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Поступление успешно добавлено!`,
                })
                this.$router.push({name: 'income.index'})
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
            if (this.item.agent.id === -1) this.errors.push("Поле \"Поставщик\" должно быть заполнено");
            if (this.item.storage.id === -1) this.errors.push("Поле \"Склад\" должно быть заполнено");

            this.item.table_rows.forEach(p => {
                if (p.nomenclature.id === -1) this.errors.push(`Строка № ${p.table_id}. Поле \"Номенклатура\" должно быть заполнено`);
                if (p.characteristic.serial === "") this.errors.push(`Строка № ${p.table_id}. Поле \"Серия\" должно быть заполнено`);
                if (p.characteristic.expiry_date === "") this.errors.push(`Строка № ${p.table_id}. Поле \"Срок годности\" должно быть заполнено`);
                if (p.income_price <= 0) this.errors.push(`Строка № ${p.table_id}. Поле \"Цена поступления\" должно быть больше 0`);
                if (p.characteristic.characteristic_price.price <= 0) this.errors.push(`Строка № ${p.table_id}. Поле \"Цена продажи\" должно быть больше 0`);
                if (p.count <= 0) this.errors.push(`Строка № ${p.table_id}. Поле \"Количество\" должно быть больше 0`);
            })

            this.showErrors()

            return this.errors.length === 0;
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
</script>

<style scoped>

</style>
