<template>
    <div>
        <el-row v-shortkey="['del']" v-if="choosing_state === 0 " @shortkey="deleteSelected" class="center-75">

            <div>
                <el-button style="float: left"  type="danger" icon="el-icon-close" @click="back" ></el-button>
                <h1 class="text-center">Выбор номенклатуры</h1>
            </div>


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

import mixin_index from "../../code/mixins/mixin_index";
import mixin_filterable from "../../code/mixins/mixin_filterable";

export default {
    name: "NomenclatureChoose",

    mixins: [mixin_filterable, mixin_index, ],
    data: function () {
        return {
            default_filter_fields: {
                name_str: "",
                producer: {name: ""},
                price_type: {name: ""},

            },
            choosing_state: 0,
            action_namespace: "nomenclature",
            filter_namespace: "nomenclature"
        };
    },
    methods: {

        getParamsPreset(){
            return {
                name: this.filter_fields.name_str,
                producer_id: this.filter_fields.producer.id,
                price_type_id: this.filter_fields.price_type.id
            }
        },
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

