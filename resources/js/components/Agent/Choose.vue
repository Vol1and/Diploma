<template>
    <el-row style="margin-bottom: 50px"  @shortkey="deleteSelected" class="center-75">



        <div>
            <el-button style="float: left"  type="danger" icon="el-icon-close" @click="back" ></el-button>
            <h1 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Контрагенты</h1>
        </div>

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
                  @row-dblclick=""
                  @current-change="selected">

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
    name: "AgentChoose",

    mixins: [mixin_index],
    data: function () {
        return {

            action_namespace: "agents"

        };
    },
    mounted() {
        this.update();
    },
    methods: {
        rowSelected(id) {

            this.selected_item = id;
        },

        update: function () {
            this.is_reload = true;
            this.$store.dispatch('agents/update').then(() => {
                this.is_reload = false;
                this.page_count = this.$store.getters['agents/items_length'](this.items_per_page);
                this.current_page = 1;
                this.onChangePage();

            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
                this.is_reload = false;
            }));

        },
        selected(selected_item) {
            this.$emit("selected", {agent: selected_item});
        },
        back() {
            this.$emit("back");
        }

    }

}
</script>

<style scoped>


</style>
