<template>

    <div class="center-75">
        <h1 class="text-center">Контрагенты</h1>
        <div class="row">
            <router-link :to="{name: 'agents.create'}" style=" float:left " class="btn btn-in-bar  btn-primary">Добавить</router-link>

            <!--            <button @click="update"  v-if="!is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">Обновить </button>-->
            <!--            <button disabled v-if="is_reload" style="float:right;" class=" btn-in-bar btn btn-danger"> Обновление...</button>-->
        </div>

        <table class="table">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Биллинг</th>
                <th>Адрес</th>
                <th>Доп. информация</th>
            </tr>
            <tbody>
            <tr v-for="item in page_of_items" class="row-hover"  :key="item.id" :class="{'highlight': (item.id === selected_item)}"
                @click="rowSelected(item.id)"  @dblclick="toEdit(item.id)">
                <td>{{ item.id }}</td>
                <td>{{ item.name}}</td>
                <td>{{ item.billing}}</td>
                <td>{{ item.address}}</td>
                <td>{{ item.description}}</td>
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
    name: "AgentsIndex",

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
            axios.get('/api/agents').then((response) => {
                this.is_reload = true;


                this.items = response.data;
                this.page_count = Math.ceil(this.items.length/this.items_per_page);
                this.onChangePage();
                this.is_reload = false;
            });
        },
        onChangePage(){
            // update page of items
            this.page_of_items = this.items.slice(this.items_per_page*(this.current_page-1), (this.items_per_page*this.current_page));
        },

        toEdit(id){
            this.$router.push({name: 'agents.edit', params:{id : id}});
        }
    }

}
</script>

<style scoped>


</style>
