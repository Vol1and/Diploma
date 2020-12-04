<template>

    <div class="center-50">
        <h1 class="text-center">Ценовые группы</h1>
        <div class="row">
            <router-link :to="{name: 'price-types.create'}" style=" float:left " class="btn btn-in-bar  btn-primary">Добавить</router-link>

            <!--            <button @click="update"  v-if="!is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">Обновить </button>-->
            <!--            <button disabled v-if="is_reload" style="float:right;" class=" btn-in-bar btn btn-danger"> Обновление...</button>-->
        </div>

        <table class="table  table-hover">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Наценка</th>
            </tr>
            <tbody>
            <tr v-for="item in page_of_items" @dblclick="toEdit(item.id)">
                <td>{{ item.id }}</td>
                <td>{{item.name}}</td>
                <td>{{ item.margin}}</td>
            </tr>
            </tbody>
        </table>
        <div class="centered">
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
    name: "PriceTypeIndex",

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
            axios.get('api/price-types').then((response) => {
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
        },

        toEdit(id){
            this.$router.push({name: 'price-types.edit', params:{id : id}});
        }
    }

}
</script>

<style scoped>


</style>
