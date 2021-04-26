<template>
    <el-row style="margin-bottom: 50px" v-shortkey="['del']" @shortkey="deleteSelected" class="center-75">


        <h1 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Контрагенты</h1>

        <el-row>
            <el-col :span="8">
                <router-link tag="button" class="el-button" :to="{name: 'agents.create'}" style=" float:left ">
                    Добавить
                </router-link>
            </el-col>

            <el-col :span="8" :offset="8">
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
                prop="id"
                label="#"
                min-width="15"
            >
            </el-table-column>
            <el-table-column
                prop="name"
                label="Наименование"
            >
            </el-table-column>
            <el-table-column
                prop="billing"
                label="Биллинг"
                width="550">
            </el-table-column>
            <el-table-column
                prop="address"
                label="Адрес"
                width="350">
            </el-table-column>
            <el-table-column
                prop="description"
                label="Доп. информация"
                width="350">
            </el-table-column>
        </el-table>
        <div class="centered">
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
    name: "AgentIndex",

    mixins: [mixin_index],
    data: function () {
        return {
            action_namespace: "agents"
        };
    },

}
</script>

<style scoped>


</style>
