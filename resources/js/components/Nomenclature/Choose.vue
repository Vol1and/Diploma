<template>
    <div>
        <el-row v-shortkey="['del']" v-if="choosing_state === 0 " @shortkey="deleteSelected" class="center-75">


            <h1 class="text-center">Выбор номенклатуры</h1>

            <el-row>
                <el-col :span="8">
                    <router-link tag="button" class="el-button" :to="{name: 'nomenclature.create'}"
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
                    <el-form-item style="   margin-bottom: 0;" label="Название:">
                        <el-input v-model="filter_fields.name_str" placeholder="Название"></el-input>
                    </el-form-item>
                    <el-form-item style="   margin-bottom: 0;" label="Производитель:">
                        <el-input readonly v-model="filter_fields.producer.name" placeholder="">
                            <el-button type="primary" @click="selectingProducer" slot="append"
                                       icon="el-icon-d-arrow-right"></el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item style="   margin-bottom: 0;" label="Ценовая группа:">
                        <el-input readonly v-model="filter_fields.price_type.name" placeholder="">
                            <el-button type="primary" @click="selectingPriceType" slot="append"
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
                    prop="producer.name"
                    label="Производитель"
                    width="400"
                >
                </el-table-column>
                <el-table-column
                    prop="price_type.name"
                    label="Ценовая группа"
                    width="200"
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
        <producer-choose-component @back="onBack" v-if="choosing_state === 1"
                                   @selected="onSelectedProducer"></producer-choose-component>
        <price-type-choose-component @back="onBack" v-if="choosing_state === 2"
                                     @selected="onSelectedPriceType"></price-type-choose-component>
    </div>

</template>


<script>
import Producer from "../../code/models/Producer";
import Nomenclature from "../../code/models/Nomenclature";
import PriceType from "../../code/models/PriceType";
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "NomenclatureChoose",

    mixins: [mixin_index],
    data: function () {
        return {

            filter_fields: {
                name_str: "",
                producer: {name: ""},
                price_type: {name: ""},

            },
            choosing_state: 0,
            action_namespace : "nomenclature"

        };
    },
    methods: {

        update: function () {
            this.filter_state = false
            this.filter_fields = {
                name_str: "",
                producer: {name: "", id: null},
                price_type: {name: "", id: null},
            }
            this.is_reload = true;
            this.$store.dispatch('nomenclature/update').then(() => {
                this.is_reload = false;
                this.page_count = this.$store.getters['nomenclature/items_length'](this.items_per_page);
                this.current_page = 1;
                this.onChangePage('nomenclature/items');

            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
                this.is_reload = false;
            }));

            //console.log(this.$store.getters['nomenclature/last_updated']);
        },

        filter() {
            this.filter_state = true;
            axios.get('/api/nomenclature/filter', {
                params: {
                    name: this.filter_fields.name_str,
                    producer_id: this.filter_fields.producer.id,
                    price_type_id: this.filter_fields.price_type.id
                }
            }).then((response) => {
                this.page_of_items = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => this.page_of_items.push(new Nomenclature(item.id,
                    item.name,
                    new Producer(item.producer.id, item.producer.name, item.producer.country, item.producer.created_at, item.producer.updated_at, item.producer.deleted_at),
                    new PriceType(item.price_type.id, item.price_type.name, item.price_type.margin, item.price_type.created_at, item.price_type.updated_at, item.price_type.deleted_at),
                    item.created_at,
                    item.updated_at,
                    item.deleted_at)))

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        },

        switch_filter() {
            this.filter_visible = !this.filter_visible;
        },

        selectingProducer() {
            this.choosing_state = 1;
        },
        selectingPriceType() {
            this.choosing_state = 2;
        },

        onSelectedProducer(data) {
            this.filter_fields.producer = data.producer;
            this.choosing_state = 0;
        },

        onSelectedPriceType(data) {
            this.filter_fields.price_type = data.price_type;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        },
        selected(selected_item) {
            this.$emit("selected", {nomenclature: selected_item});
        },
        back() {
            this.$emit("back");
        }
    }

}
</script>

