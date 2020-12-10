<template>

    <div class="center-50">
        <div>
            <button @click="back()" class="btn  btn-primary"><--</button>
            <h1 class="text-center">Выбор ценовой группы </h1>
        </div>

        <div class="row">
            <router-link :to="{name: 'price-types.create'}" style=" float:left " class="btn btn-in-bar  btn-primary">Добавить</router-link>

            <!--            <button @click="update"  v-if="!is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">Обновить </button>-->
            <!--            <button disabled v-if="is_reload" style="float:right;" class=" btn-in-bar btn btn-danger"> Обновление...</button>-->
        </div>

        <table class="table">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Наценка</th>
            </tr>
            <tbody>
            <tr v-for="item in page_of_items" class="row-hover"  :key="item.id" :class="{'highlight': (item.id === selected_item)}"
                @click="rowSelected(item.id)"  @dblclick="selected(item)">
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
    name: "PriceTypeChoose",

    data: function () {
        return {

            current_page : 1,
            items_per_page : 10,
            page_count : 1,
            items: [],
            selected_item : null,
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
            axios.get('/api/price-types').then((response) => {
                console.log(response.data)
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

        selected(selected_item){
            this.$emit("selected", {price_type: selected_item});
        },
        back(){
            this.$emit("back");
        }
    }

}
</script>

<style scoped>


</style>
