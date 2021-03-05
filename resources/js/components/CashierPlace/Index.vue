<template>
    <div>
        <el-row v-if=" choosing_state === 0 ">

            <el-col :span="20" :offset="2">


                <el-card class="box-card">
                    <div slot="header">
                        <el-row>
                            <el-col :span="8"><h4 :span="8" style="float: left">Рабочее место:
                                {{ this.workplace.name }}</h4></el-col>
                            <el-col :span="8"><h3 :span="8"
                                                  v-shortkey="{del: ['del'], f2: ['f2'], change : ['alt', 'q'],change_rus : ['alt', 'й']}"
                                                  @shortkey="theAction" class="text-center">Рабочее место кассира</h3>
                            </el-col>
                            <el-col :span="8"><h4 :span="6" style="float: right">Пользователь: {{$store.getters["auth/user"].name}} </h4></el-col>
                        </el-row>
                    </div>
                    <el-form label-width="100px" label-position="right">

                        <el-card v-if="workplace.id != null" style="margin-bottom: 40px">

                            <el-divider content-position="left"><h2>Товары</h2></el-divider>

                            <el-row style="margin-bottom: 10px">
                                <el-button @click="selectingNomenclature">Поиск товара [F2]</el-button>
                                <el-button :disabled="rows_sum ===0 " @click="cashInput_dialog = true">Оплата [Alt +
                                    Q]
                                </el-button>
                                <el-tooltip class="item" effect="light" content="Удалить выбранную строку"
                                            placement="top">
                                    <el-button @click="deleteSelected" circle icon="el-icon-delete-solid"></el-button>
                                </el-tooltip>

                                <h1 style="float: right">{{ this.status_label }}</h1>
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
                                        <div autofocus v-show="selectingRow !== scope.row"> {{ scope.row.count }} шт.</div>
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


                                        <div> {{ scope.row.characteristic.characteristic_price.price }} руб.
                                        </div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </el-card>

                        <el-button v-else style="margin: 0 auto;" @click="selectingWorkPlace">Выбрать рабочее место</el-button>
                    </el-form>

                </el-card>



            </el-col>

        </el-row>
        <MedicamentSearch @back="onBack" v-if="choosing_state === 2"  :storage_id="workplace.storage.id"
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
        <workplace-choose-component @back="onBack" v-if="choosing_state ===3"
                                    @selected="onSelectedWorkPlace">
        </workplace-choose-component>
    </div>
</template>

<script>


import FinanceDocument from "../../code/models/FinanceDocument";
import MedicamentSearch from "./MedicamentSearch";
import CashInput from "./CashInput";
import mixin_cashier_place from "../../code/mixins/mixin_cashier_place";
import WorkPlace from "../../code/models/WorkPlace";

export default {
    name: "CashierIndex",
    components: {CashInput, MedicamentSearch},
    mixins: [mixin_cashier_place],
    data() {
        return {
            item: new FinanceDocument(null, 1),
            cashInput_dialog: false,
            change: 0
        }
    },
    //ивент, срабатывающий при created стадии компонента - в поле дата закидывает текущую дату
    created() {
        this.item.date = Date.now();

    },
    computed: {

        status_label: function () {

            if (this.rows_sum === 0 && this.change > 0) return `Сдача: ${this.change}`

            return `Сумма: ${this.rows_sum}`

        },

        rows_sum: function () {

            let sum = 0;

            this.item.table_rows.forEach(p => {
                sum += p.count * p.characteristic.characteristic_price.price
            });
            return sum;
        }
    },
    methods: {
        theAction(event) {
            switch (event.srcKey) {
                case 'del':
                    this.deleteSelected();
                    break;
                case 'f2':
                    if(this.workplace.id != null)
                    this.selectingNomenclature();
                    break;
                case 'change':
                case 'change_rus':
                    if (this.rows_sum > 0)
                        this.cashInput_dialog = true;
                    break;
            }
        },
        //сабмит - отправляет данные
        submit: function (statet) {
            //не проходит валидацию - возвращаем
            if (!this.validateFields()) return;
            //блокируем кнопку submit
            this.loaded = false;
            console.log(this.item.getDataForCreate())
            //пост-запрос
            //отправляет данные, полученные из специально подготовленного метода, чтобы не отправлять лишаки
            axios.post("/api/income", {item: this.item.getDataForCreate(), state: statet}).then((response) => {
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


            axios.post('/api/cashier/send', {items: this.item.getDataForCashier(), workplace_id: this.workplace.id, user_id: this.$store.getters["auth/user"].id}).then((response)=>{
                console.log(response.data);
                this.change = data.change;
                this.cashInput_dialog = false;
                this.item.table_rows = [];
                this.selectingRow = null;
            }).catch(error =>{
                console.log("Произошла ошибка! " + error.message)
            })

        },



    }
}
</script>

<style scoped>

</style>
