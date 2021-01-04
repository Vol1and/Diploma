<template>

    <div>
        <div v-if="choosing_state === 0 " class="center-75">
            <h1 class="text-center">Номенклатура</h1>
            <div class="row">
                <router-link :to="{name: 'nomenclature.create'}" style=" float:left "
                             class="btn btn-in-bar text-center btn-primary">
                    Добавить
                </router-link>
                <button @click="switch_filter()" v-if="!filter_visible"
                        class="btn btn-in-bar center-block  btn-primary">
                    Фильтры
                </button>
                <button @click="switch_filter()" v-else class="btn btn-in-bar center-block  btn-danger">Закрыть</button>


                <button @click="update" :disabled="is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">
                    Обновить
                </button>
            </div>
            <div class="row" style="margin-bottom: 10px" v-if="filter_visible">


                <div class="col-md-3">
                    <label class="col-form-label-lg" for="name_input">
                        Поиск:
                    </label>
                    <div class="input-group ">
                        <input id="name_input" v-model="filter_fields.name_str"
                               class=" form-control "/>

                    </div>

                </div>


                <div class="col-md-3">
                    <label class="col-form-label-lg" for="producer_input">
                        Производитель:
                    </label>
                    <div class="input-group ">
                        <input type="text" disabled name="price_type_input" :value="filter_fields.producer.name"
                               id="producer_input"
                               class="form-control "/>

                        <div class="input-group-append">
                            <button @click="selectingProducer()" type="button" class="btn btn-primary">>></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-form-label-lg" style="float: left" for="price_type_input">
                        Ценовая группа:
                    </label>
                    <div class="input-group ">
                        <input type="text" disabled name="price_type_input" :value="filter_fields.price_type.name"
                               id="price_type_input"
                               class="form-control "/>

                        <div class="input-group-append">
                            <button @click="selectingPriceType()" type="button" class="btn btn-primary">>></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button @click="filter" style="float: right" class="  btn btn btn-in-bar btn-primary">
                        Поиск
                    </button>
                </div>


            </div>


            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Производитель</th>
                    <th>Ценовая группа</th>
                </tr>
                <tbody>
                <tr v-for="item in page_of_items" class="row-hover" :key="item.id"
                    :class="{'highlight': (item.id === selected_item)}"
                    @click="rowSelected(item.id)" @dblclick="toEdit(item.id)">
                    <td> {{ item.id }}</td>
                    <td> {{ item.name }}</td>
                    <td> {{ item.producer.name }}</td>
                    <td> {{ item.price_type.name }}</td>
                </tr>
                </tbody>
            </table>
            <div class="centered">
                <paginate v-if="!filter_state"
                          v-model="current_page"
                          :page-count="page_count"
                          :page-range="3"
                          :click-handler="onChangePage"
                          :prev-text="'<<'"
                          :next-text="'>>'"
                          :container-class="'pagination'"
                          :active-class="'pagination-active'"
                >
                </paginate>
            </div>

        </div>
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
    name: "NomenclatureIndex",

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
        }

    }

}
</script>

<style scoped>


</style>
