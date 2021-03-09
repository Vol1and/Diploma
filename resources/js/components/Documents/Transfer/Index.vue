<template>
    <div>
        <el-row v-if="choosing_state === 0 " class="center-75">


            <h1 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Перемещения товаров</h1>

            <el-row>
                <el-col :span="8">
                    <router-link tag="button" class="el-button" :to="{name: 'transfers.create'}"
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
                    <el-form-item style="   margin-bottom: 0;" label="Склад:">
                        <el-input readonly v-model="filter_fields.source_storage.name" placeholder="">
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
                      border
                      highlight-current-row
                      @row-dblclick="toEdit"
                      @current-change="rowSelected">
                <el-table-column
                    label="Статус"
                    min-width="40"
                >
                    <template slot-scope="scope">

                        <el-button type="info" icon="el-icon-folder-checked" size="mini" readonly v-if="scope.row.is_set === 0" circle></el-button>

                        <el-button type="success" icon="el-icon-check" size="mini" readonly v-else circle></el-button>
                    </template>
                </el-table-column>
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
                    prop="source_storage.name"
                    label="Склад-отправитель"
                    min-width="100"
                >
                </el-table-column>

                <el-table-column
                    prop="destination_storage.name"
                    label="Склад-получатель"
                    min-width="100"
                >
                </el-table-column>
                <el-table-column

                    prop="doc_sum"
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
        <storage-choose-component @back="onBack" v-if="choosing_state ===2"
                                  @selected="onSelectedStorage"></storage-choose-component>
    </div>
</template>


<script>
import mixin_index from "../../../code/mixins/mixin_index";
import StorageDocumentTableRow from "../../../code/models/StorageDocumentTableRow";
import StorageDocument from "../../../code/models/StorageDocument";
import Storage from "../../../code/models/Storage";
import moment from "moment";

export default {
    name: "TransferIndex",

    mixins: [mixin_index],
    data: function () {
        return {

            filter_fields: {
                date_range : {},
                source_storage: {name: ""},

            },
            choosing_state: 0,
            action_namespace: "transfers"

        };
    },
    methods: {

        filterClear() {

            this.filter_fields = {
                date_range : {},
                source_storage: {name: ""}
            }

        },


        filter() {
            this.filter_state = true;
            axios.get('/api/transfer-document/filter', {

                params: {
                    start_date: this.filter_fields.date_range[0] === undefined ? null:    moment(this.filter_fields.date_range[0]).format("YYYY-MM-DD hh:mm:ss") ,
                    end_date: this.filter_fields.date_range[1] === undefined ? null:  moment(this.filter_fields.date_range[1]).format("YYYY-MM-DD hh:mm:ss") ,
                    source_storage_id: this.filter_fields.source_storage.id,
                    destination_storage_id: this.filter_fields.destination_storage.id
                }

            }).then((response) => {

                let result = [];

                //console.log(response.data)
                let table_rows = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => {


                    if (item.table_rows !== undefined && item.table_rows.length > 0) item.table_rows.forEach(row => table_rows.push(new StorageDocumentTableRow(row.id, row.nomenclature, row.characteristic, row.count, row.income_price, row.sell_price)));


                    result.push(new StorageDocument(item.id,
                        new Storage(item.source_storage.id, item.source_storage.name),
                        item.date, table_rows,
                        new Storage(item.destination_storage.id, item.destination_storage.name),
                        item.comment,
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

        onSelectedStorage(data) {
            this.filter_fields.source_storage = data.source_storage;
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
