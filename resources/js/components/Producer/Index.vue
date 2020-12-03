<template>

    <div class="center-50">
        <h1 class="text-center">Производители</h1>
        <div class="row">
            <router-link :to="{name: 'producers.create'}" style=" float:left " class="btn btn-in-bar  btn-primary">Добавить</router-link>

            <!--            <button @click="update"  v-if="!is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">Обновить </button>-->
            <!--            <button disabled v-if="is_reload" style="float:right;" class=" btn-in-bar btn btn-danger"> Обновление...</button>-->
        </div>

        <table class="  table table-striped">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Страна</th>
            </tr>
            <tbody>
            <tr v-for="item in page_of_items">
                <td>{{ item.id }}</td>
                <td><router-link :to="{name: 'producers.edit', params:{id : item.id}}">{{ item.name}}</router-link></td>
                <td>{{ item.country}}</td>
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
    name: "ProducerIndex",

    data: function () {
        return {

            current_page : 1,
            items_per_page : 10,
            page_count : 1,
            items: [],
            page_of_items: [],
            is_reload: false,

        };
    },
    mounted() {
        this.update();
    },
    methods: {


        update: function () {
            axios.get('api/producers').then((response) => {
                this.is_reload = true;


                this.items = response.data;
                this.page_count = Math.ceil(this.items.length/this.items_per_page);
                this.onChangePage();
                this.is_reload = false;
            });
        },
        onChangePage(){
            // update page of items
            this.page_of_items = this.items.slice(this.items_per_page*(this.current_page-1), (this.items_per_page*this.current_page) -1);
        }

    }

}
</script>

<style scoped>


</style>
