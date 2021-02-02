<template>
    <el-row v-shortkey="['del']" @shortkey="deleteSelected" class="center-75">


        <div>
        <el-button style="float: left"  type="danger" icon="el-icon-close" @click="back" ></el-button>
        <h1 class="text-center">Ценовые группы</h1>
        </div>
        <el-row>
            <el-col :span="8">
                <router-link tag="button" class="el-button" :to="{name: 'pricetypes.create'}" style=" float:left ">
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
                prop="margin"
                label="Наценка"
                width="150"
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
    name: "PriceTypeChoose",

    mixins: [mixin_index],
    data: function () {
        return {
            action_namespace: "pricetypes"
        };
    },
    mounted() {
        this.update();
    },
    methods: {
        update: function () {

            this.is_reload = true;
            this.$store.dispatch('pricetypes/update').then(() => {
                this.page_count = this.$store.getters['pricetypes/items_length'](this.items_per_page);
                this.onChangePage();
                this.is_reload = false;
            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
                this.is_reload = false;
            }));

        },
        selected(selected_item) {
            this.$emit("selected", {price_type: selected_item});
        },
        back() {
            this.$emit("back");
        },
        deleteSelected() {
        }
    }

}
</script>

<style scoped>


</style>
