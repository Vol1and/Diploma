<template>
    <el-row class="center-75">


        <h1 v-shortkey="['del']" @shortkey="deleteSelected" class="text-center">Ценовые группы</h1>

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
export default {
    name: "CharacteristicForNomenclature",


    data: function () {
        return {


            current_page: 1,
            items_per_page: 10,
            page_count: 1,
            items: [],
            selected_item: null,
            page_of_items: [],
            is_reload: false,

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
            axios.get(`/api/characteristic/for-nomenclature/${this.$route.params.id}`).then((response) => {
                this.is_reload = true;


                this.items = response.data;
                this.page_count = Math.ceil(this.items.length / this.items_per_page);
                this.onChangePage();
                this.is_reload = false;
            });
        },
        onChangePage() {
            // update page of items
            this.page_of_items = this.items.slice(this.items_per_page * (this.current_page - 1), (this.items_per_page * this.current_page));
        },

        toEdit(id) {
            this.$router.push({name: 'nomenclatures.edit', params: {id: id}});
        }
    }
}
</script>

<style scoped>

</style>
