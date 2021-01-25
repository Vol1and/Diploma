<template>
    <div>
        <el-row v-if="choosing_state === 0 " class="center-75">


            <h1 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Поступления товаров</h1>

            <el-row>
                <el-col :span="8">
                    <router-link tag="button" class="el-button" :to="{name: 'income.create'}"
                                 style=" float:left ">
                        Добавить
                    </router-link>
                </el-col>
                <el-col justify="center" :span="8">
                    <el-col :span="8" :offset="8">
                        <el-button icon="el-icon-s-operation" style="width: 100%" @click="switch_filter()"
                                   v-if="!filter_visible">
                            Фильтры
                        </el-button>
                        <el-button @click="switch_filter()" style="width: 100%" v-else type="danger">Закрыть</el-button>
                    </el-col>
                </el-col>

                <el-col :span="8">
                    <el-button icon="el-icon-refresh" @click="update" :disabled="is_reload" style="float:right;">
                        Обновить
                    </el-button>
                </el-col>
            </el-row>

            <el-row v-if="filter_visible">
                <el-divider></el-divider>
                <el-form :inline="true" class="demo-form-inline">
                    <el-form-item style="   margin-bottom: 0;" label="Дата:">
                        <el-date-picker
                            v-model="filter_fields.date_range"
                            type="daterange"
                            range-separator="-"
                            start-placeholder="Начало"
                            end-placeholder="Конец"
                            :default-value="null"
                          >
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item style="   margin-bottom: 0;" label="Поставщик:">
                        <el-input readonly v-model="filter_fields.agent.name" placeholder="">
                            <el-button type="primary" @click="selectingAgent" slot="append"
                                       icon="el-icon-d-arrow-right"></el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item style="   margin-bottom: 0;" label="Склад:">
                        <el-input readonly v-model="filter_fields.storage.name" placeholder="">
                            <el-button type="primary" @click="selectingStorage" slot="append"
                                       icon="el-icon-d-arrow-right"></el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item style="   margin-bottom: 0;">
                        <el-button type="primary" @click="filter">Поиск</el-button>
                    </el-form-item>
                </el-form>
            </el-row>
            <el-divider></el-divider>
            <el-table :data="page_of_items"
                      highlight-current-row
                      @row-dblclick="toEdit"
                      @current-change="rowSelected">
                <el-table-column
                    prop="id"
                    label="#"
                    min-width="35"
                >
                </el-table-column>
                <el-table-column
                    prop="date"
                    label="Дата"
                    min-width="100"
                >
                </el-table-column>
                <el-table-column
                    prop="agent.name"
                    label="Поставщик"
                    min-width="200"
                >
                </el-table-column>
                <el-table-column
                    prop="storage.name"
                    label="Склад"
                    min-width="100"
                >
                </el-table-column>
                <el-table-column

                    prop="income_sum"
                    label="Сумма документа"
                    min-width="100"
                >
                </el-table-column>
                <el-table-column

                    prop="comment"
                    label="Комментарий"
                    min-width="200"
                >
                </el-table-column>
            </el-table>
            <div v-if="!filter_state" class="centered">
                <el-pagination
                    height="250"
                    @current-change="onChangePage"
                    :current-page.sync="current_page"
                    :page-size="items_per_page"
                    layout="prev, pager, next, jumper"
                    :page-count="page_count"
                >
                </el-pagination>
            </div>
        </el-row>
        <agent-choose-component @back="onBack" v-if="choosing_state ===1"
                                @selected="onSelectedAgent"></agent-choose-component>
        <storage-choose-component @back="onBack" v-if="choosing_state ===2"
                                  @selected="onSelectedStorage"></storage-choose-component>
    </div>
</template>


<script>
import mixin_index from "../../../code/mixins/mixin_index";
import FinanceDocumentTableRow from "../../../code/models/FinanceDocumentTableRow";
import IncomeDocument from "../../../code/models/IncomeDocument";
import Agent from "../../../code/models/Agent";
import Storage from "../../../code/models/Storage";
import moment from "moment";

export default {
    name: "IncomeIndex",

    mixins: [mixin_index],
    data: function () {
        return {

            filter_fields: {
                date_range : {},
                agent: {name: ""},
                storage: {name: ""},

            },
            choosing_state: 0,
            action_namespace: "income"

        };
    },
    methods: {

        filterClear() {

            this.filter_fields = {
                date_range : {},
                agent: {name: ""},
                storage: {name: ""}
            }

        },


        filter() {
            this.filter_state = true;
            console.log( {
                    start_date: this.filter_fields.date_range[0],
                    end_date: this.filter_fields.date_range[1],
                    agent_id: this.filter_fields.agent.id,
                    storage_id: this.filter_fields.storage.id
            });
            axios.get('/api/income-document/filter', {

                params: {
                    start_date: this.filter_fields.date_range[0] === undefined ? null:    moment(this.filter_fields.date_range[0]).format("YYYY-MM-DD hh:mm:ss") ,
                    end_date: this.filter_fields.date_range[1] === undefined ? null:  moment(this.filter_fields.date_range[1]).format("YYYY-MM-DD hh:mm:ss") ,
                    agent_id: this.filter_fields.agent.id,
                    storage_id: this.filter_fields.storage.id
                }

            }).then((response) => {

                let result = [];


                //console.log(response.data)
                let table_rows = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => {


                    if (item.table_rows !== undefined && item.table_rows.length > 0) item.table_rows.forEach(row => table_rows.push(new FinanceDocumentTableRow(row.id, row.nomenclature, row.characteristic, row.count, row.income_price, row.sell_price)));


                    result.push(new IncomeDocument(item.id,
                        new Agent(item.agent.id, item.agent.name, item.agent.billing, item.agent.address, item.agent.description, item.agent.created_at, item.agent.updated_at, item.agent.deleted_at),
                        new Storage(item.storage.id, item.storage.name, item.agent.created_at, item.agent.updated_at, item.agent.deleted_at),
                        item.date, table_rows,null, item.comment,
                        item.created_at, item.updated_at, item.deleted_at))

                })
                this.page_of_items = result;
            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        },

        switch_filter() {
            this.filter_visible = !this.filter_visible;
        },

        selectingStorage() {
            this.choosing_state = 2;
        },
        selectingAgent() {
            this.choosing_state = 1;
        },

        onSelectedStorage(data) {
            this.filter_fields.storage = data.storage;
            this.choosing_state = 0;
        },

        onSelectedAgent(data) {
            this.filter_fields.agent = data.agent;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        }

    }

}
</script>

<style scoped>


</style>
