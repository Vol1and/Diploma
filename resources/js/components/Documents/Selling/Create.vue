<template>
    <div>
        <el-row v-if=" choosing_state === 0 ">

            <el-col :span="20" :offset="2">
                <el-card class="box-card">
                    <div slot="header">
                        <h2 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Новая реализация
                            товаров</h2>
                    </div>
                    <el-form label-width="100px" label-position="right">

                        <div style="margin-bottom: 30px">
                            <el-button type="primary" @click="submit(true)"><i class="el-icon-finished"></i> Провести
                            </el-button>
                            <el-button @click="submit(false)"><i class="el-icon-folder-checked"></i> Записать
                            </el-button>
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
                                                    type="datetime" format="yyyy-MM-dd HH:mm:ss"/>
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
                                    prop="characteristic.name"
                                    label="Характеристика"
                                    sortable
                                >
                                    <template slot-scope="scope">

                                        <el-input v-if="selectingRow === scope.row" readonly
                                                  v-model="scope.row.characteristic.name" placeholder="">
                                            <el-button type="primary" @click="characteristic_dialog = true;"
                                                       :disabled="scope.row.nomenclature.id === -1 || item.storage.id === -1 "
                                                       slot="append"
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
                                            <template slot="append">шт.</template>
                                        </el-input>
                                        <div v-else> {{ scope.row.count }} шт.</div>
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
                                                  placeholder="" readonly>
                                            <template slot="append">руб.</template>
                                        </el-input>
                                        <div v-else> {{ scope.row.characteristic.characteristic_price.price }} руб.
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
                                        {{ scope.row.characteristic.characteristic_price.price * scope.row.count}} руб.
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

            <characteristic-choose-with-wares-component :storage_id="item.storage.id" @back="onBack"
                                                        v-if="characteristic_dialog"
                                                        :nomenclature_id="selectingRow.nomenclature.id"
                                                        @selected="onSelectedCharacteristic"></characteristic-choose-with-wares-component>
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


import mixin_finance_document from "../../../code/mixins/mixin_finance_document";
import FinanceDocument from "../../../code/models/FinanceDocument";

export default {
    name: "SellingCreate",

    mixins: [mixin_finance_document],
    data() {
        return {
            item: new FinanceDocument(null, 2)
        }
    },
    //ивент, срабатывающий при created стадии компонента - в поле дата закидывает текущую дату
    created() {
        this.item.date = Date.now();
    },
    methods: {
        //сабмит - отправляет данные
        submit: function (statet) {
            //не проходит валидацию - возвращаем
            if (!this.validateFields()) return;

            //блокируем кнопку submit
            this.loaded = false;

            console.log(this.item)
            //пост-запрос
            //отправляет данные, полученные из специально подготовленного метода, чтобы не отправлять лишаки
            axios.post("/api/selling", {item: this.item.getDataForCreate(), state: statet}).then((response) => {
                console.log(response.data);
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Реализация успешно проведена!`,
                })
                this.$router.push({name: 'selling.index'})
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
            if (this.item.storage.id === -1) this.errors.push("Поле \"Склад\" должно быть заполнено");

            this.item.table_rows.forEach(p => {
                if (p.nomenclature.id === -1) this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Номенклатура\" должно быть заполнено`);
                if (p.characteristic.serial === "") this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Серия\" должно быть заполнено`);
                if (p.characteristic.expiry_date === "") this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Поле \"Срок годности\" должно быть заполнено`);//if (p.sell_price <= 0) this.errors.push(`Строка № ${this.item.table_rows.indexOfp}. Поле \"Цена продажи\" должно быть больше 0`);
                if ((p.count - p.characteristic.ware) > 0)
                    this.errors.push(`Строка № ${this.item.table_rows.indexOf(p) + 1}. Количество превышает остаток на Складе "${this.item.storage.name}". Текущий остаток - ${p.characteristic.ware}. Запрашиваемое ко-во: ${p.count}`);
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



