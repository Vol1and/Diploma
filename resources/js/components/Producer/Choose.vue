<template>
    <el-row class="center-75">

        <h1 class="text-center">Выбор производителя</h1>

        <el-row>
            <el-col :span="8">
                <router-link tag="button" class="el-button" :to="{name: 'producers.create'}" style=" float:left ">
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
                <el-form-item style="   margin-bottom: 0;" label="Название:">
                    <el-input v-model="filter_fields.name_str" placeholder="Название"></el-input>
                </el-form-item>
                <el-form-item style="   margin-bottom: 0;" label="Страна:">
                    <el-input v-model="filter_fields.country_str" placeholder="Страна"></el-input>
                </el-form-item>
                <el-form-item style="   margin-bottom: 0;">
                    <el-button type="primary" @click="filter">Поиск</el-button>
                </el-form-item>
            </el-form>

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
                prop="country"
                label="Страна"
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
import Producer from "../../code/models/Producer";

export default {
    name: "ProducerChoose",

    mixins: [mixin_index],
    data: function () {
        return {
            filter_fields: {
                name_str: "",
                country_str: "",

            },
            action_namespace: "producers"

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
            this.filter_state = false;
            this.filter_fields.country_str = this.filter_fields.name_str = ""
            this.$store.dispatch('producers/update').then(() => {
                this.page_count = this.$store.getters['producers/items_length'](this.items_per_page);
                this.onChangePage(1);
            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
            }))


        },

        filter() {
            this.filter_state = true;
            axios.get('/api/producer/filter', {
                params: {
                    name: this.filter_fields.name_str,
                    country: this.filter_fields.country_str
                }
            }).then((response) => {
                this.page_of_items = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => this.page_of_items.push(new Producer(item.id, item.name, item.country, item.created_at, item.updated_at, item.deleted_at)))

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        },

        //по дабл-клику - переходим на строку с изменением выбраного объекта
        selected() {

            this.$emit("selected", {producer: this.selected_item});
        },
        back() {
            this.$emit("back");
        }

    }

}
</script>

<style scoped>


</style>
