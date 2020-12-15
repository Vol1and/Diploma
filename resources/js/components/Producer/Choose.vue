<template>

    <div class="center-50">
        <div>
            <button @click="back()" class="btn  btn-primary"><--</button>
            <h1 class="text-center">Выбор производителя</h1>
        </div>
        <div class="row">
            <router-link :to="{name: 'producers.create'}" style=" float:left " class="btn btn-in-bar  btn-primary">
                Добавить
            </router-link>
            <button @click="switch_filter()" v-if="!filter_visible" class="btn btn-in-bar center-block  btn-primary">Фильтры</button>
            <button @click="switch_filter()" v-else class="btn btn-in-bar center-block  btn-danger" >Закрыть</button>


                       <button @click="update" :disabled="is_reload" style="float:right;"  class=" btn-in-bar btn btn-primary">Обновить </button>
        </div>

        <div class="row" v-if="filter_visible">

            <div class=" no-padding" style="float:right">
                <label class="col-form-label-lg" style="float: left" for="filter_input">
                    Поиск:
                </label>
                <input id="filter_input" v-model="filter_str" class=" form-control form-group btn-in-bar "
                       style="float:left; margin-left: 10px"/>
                <button @click="filter" style="float:right; margin-left: 20px" class=" btn-in-bar btn btn-primary">Поиск</button>

            </div>

        </div>
        <table class="table ">
            <tr class="bordered">
                <th>#</th>
                <th>Название</th>
                <th>Страна</th>
            </tr>
            <tbody>
            <tr v-for="item in page_of_items" class="row-hover" :key="item.id" :class="{'highlight': (item.id === selected_item)}"
                @click="rowSelected(item.id)" @dblclick="selected(item)">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.country }}</td>
            </tr>
            </tbody>
        </table>
        <div class="centered">
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
export default {
    name: "ProducerChoose",

    data: function () {
        return {

            filter_str : "",
            filter_visible : false,
            current_page: 1,
            items_per_page: 10,
            page_count: 1,
            items: [],
            page_of_items: [],
            is_reload: false,
            selected_item: -1

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
            axios.get('/api/producers').then((response) => {
                this.is_reload = true;


                this.items = response.data;
                this.page_count = Math.ceil(this.items.length / this.items_per_page);
                this.onChangePage();
                this.is_reload = false;
            });
        },
        onChangePage() {
            // update page of items
            this.page_of_items = this.items.slice(this.items_per_page * (this.current_page - 1), (this.items_per_page * this.current_page) - 1);
        },

        //по дабл-клику - переходим на строку с изменением выбраного объекта
        selected(selected_item){

            this.$emit("selected", {producer: selected_item});
        },
        switch_filter(){
            this.filter_visible = !this.filter_visible;
        },
        back(){
            this.$emit("back");
        }

    }

}
</script>

<style scoped>


</style>
