<template>
    <el-row class="center-75">


        <h1 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Выбор рабочего места</h1>

        <el-row>
            <el-col :span="8">
                <router-link tag="button" class="el-button" :to="{name: 'workplaces.create'}" style=" float:left ">
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
                  @row-dblclick="selected"
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
                prop="storage.name"
                label="Склад"

            >
            </el-table-column>
            <el-table-column
                prop="last_access"
                label="Последнее открытие"

            >
            </el-table-column>
            <el-table-column
                prop="is_opened"
                label="Открыт"

            >
                <template slot-scope="scope">

                    <div  v-if="scope.row.is_opened">Да</div>

                    <div v-else> Нет</div>
                </template>
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
</template>


<script>
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "WorkPlaceChoose",

    mixins: [mixin_index],
    data: function () {
        return {
            action_namespace: "workplaces"
        };
    },
    mounted() {
        this.update();
    },
    methods: {
        update: function () {

            this.is_reload = true;
            this.$store.dispatch('workplaces/update').then(() => {
                this.page_count = this.$store.getters['workplaces/items_length'](this.items_per_page);
                this.onChangePage();
                this.is_reload = false;
            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
                this.is_reload = false;
            }));

        },
        selected(selected_item) {
            this.$emit("selected", {workplace: selected_item});
        },
        back() {
            this.$emit("back");
        },
    }

}
</script>

<style scoped>


</style>
