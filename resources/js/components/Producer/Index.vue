<template>

    <div v-shortkey="['del']" @shortkey="deleteSelected" class="center-75">
        <v-dialog/>
        <error-component :errors="errors"></error-component>
        <h1 class="text-center">Производители</h1>
        <div class="row">
            <router-link :to="{name: 'producers.create'}" style=" float:left "
                         class="btn btn-in-bar text-center btn-primary">
                Добавить
            </router-link>
            <button @click="switch_filter()" v-if="!filter_visible" class="btn btn-in-bar center-block  btn-primary">
                Фильтры
            </button>
            <button @click="switch_filter()" v-else class="btn btn-in-bar center-block  btn-danger">Закрыть</button>


            <button @click="update" :disabled="is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">
                Обновить
            </button>
        </div>

        <div class="row" v-if="filter_visible">

            <div class=" no-padding" style="float:right">
                <label class="col-form-label-lg" style="float: left" for="name_input">
                    Поиск:
                </label>
                <input id="name_input" v-model="filter_fields.name_str" class=" form-control form-group btn-in-bar "
                       style="float:left; margin-left: 10px"/>
                <label class="col-form-label-lg" style="float: left" for="country_input">
                    Страна:
                </label>
                <input id="country_input" v-model="filter_fields.country_str"
                       class=" form-control form-group btn-in-bar "
                       style="float:left; margin-left: 10px"/>
                <button @click="filter" style="float:right; margin-left: 20px" class=" btn-in-bar btn btn-primary">
                    Поиск
                </button>

            </div>

        </div>
        <table class="table ">
            <tr class="bordered">
                <th>#</th>
                <th>Название</th>
                <th>Страна</th>
            </tr>
            <tbody>
            <tr v-for="item in page_of_items" class="row-hover" :key="item.id"
                :class="{'highlight': (item.id === selected_item)}"
                @click="rowSelected(item.id)" @keydown.delete="deleteSelected" @dblclick="toEdit(item.id)">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.country }}</td>
            </tr>
            </tbody>
        </table>
        <div v-if="!filter_state" class="centered">
            <!--            <jw-pagination :items="items" @changePage="onChangePage"></jw-pagination>-->
            <paginate
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
</template>


<script>
import Producer from "../../code/models/Producer";
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "ProducerIndex",

    mixins: [mixin_index],
    data: function () {
        return {

            filter_fields: {
                name_str: "",
                country_str: "",

            },
            //читать об этом в mixin_index
            action_namespace : "producers"
        };
    },

    methods: {

        update: function () {
            this.filter_state = false;
            this.filter_fields.country_str = this.filter_fields.name_str = ""
            this.$store.dispatch('producers/update').then(() => {
                this.page_count = this.$store.getters['producers/items_length'](this.items_per_page);
                this.onChangePage();
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

        deleteSelected() {
            console.log(`удалится элемент с id ${this.selected_item}`)
            this.$modal.show('dialog', {
                title: 'Вы уверены',
                text: 'Удалить выбранный объект?',
                buttons: [
                    {
                        title: 'Да',
                        handler: () => {
                            //  axios.delete(`/api/producers/${this.selected_item.id}`).then((response) => {
                            //      this.page_of_items = [];
                            //      //оборачиваем каждый элемент пришедших данных в модель модуля
                            //      response.data.forEach(item => this.page_of_items.push(new Producer(item.id, item.name, item.country, item.created_at, item.updated_at, item.deleted_at)))

                            //  }).catch((error) => {
                            //      //если не ок - асинхронный ответ с кодом ошибки
                            //      console.log(`Что то пошло не так. Код ответа - ${error}`)
                            //  })


                        }
                    },
                    {
                        title: 'Нет',
                        handler: () => {

                            this.$modal.hide()
                        }
                    }
                ]
            })
        }

    }

}
</script>

<style scoped>


</style>
