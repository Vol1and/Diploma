<template>
    <el-row class="center-75">


        <h1 @shortkey="deleteSelected" class="text-center">Остатки складов</h1>

        <el-row>
            <el-col :span="8" :offset="16">
                <el-button icon="el-icon-refresh" @click="update" :disabled="is_reload" style="float:right;">
                    Обновить
                </el-button>
            </el-col>
        </el-row>

        <el-divider></el-divider>
        <el-table :data="page_of_items"
                  highlight-current-row
                  @row-dblclick="toEdit"
                  @current-change="rowSelected">

            <el-table-column
                prop="storage.name"
                label="Склад"

            >
            </el-table-column>
            <el-table-column
                prop="characteristic.nomenclature.name"
                label="Номенклатура"

            >
            </el-table-column>

            <el-table-column
                prop="characteristic.serial"
                label="Серия"
            >
            </el-table-column>
            <el-table-column
                prop="characteristic.expiry_date"
                label="Срок годности"
            >
            </el-table-column>
            <el-table-column
                prop="ware"
                label="Остаток"

            >
            </el-table-column>
        </el-table>
        <div v-if="!filter_state" class="centered">
            <!--            <jw-pagination :items="items" @changePage="onChangePage"></jw-pagination>-->

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
</template>


<script>
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "WareIndex",

    mixins: [mixin_index],
    data: function () {
        return {
            action_namespace: "wares"
        };
    },

    methods: {

        update(){
            axios.get('/api/wares').then((response) => {
                this.page_of_items = response.data;

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                reject()
                //reject(error.response.data.message);
            })
        }
    }

}
</script>

<style scoped>


</style>
