<template>

    <div class="center-50">
        <h1 class="text-center">Ценовые группы</h1>
        <div class="row">
            <router-link :to="{name: 'pricetypes.create'}" style=" float:left " class="btn btn-in-bar  btn-primary">
                Добавить
            </router-link>

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
            <tr v-for="item in page_of_items" class="row-hover" :key="item.id"
                :class="{'highlight': (item.id === selected_item)}"
                @click="rowSelected(item.id)" @dblclick="toEdit(item.id)">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.margin }}</td>
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
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "PriceTypeIndex",

    mixins: [mixin_index],
    data: function () {
        return {
            action_namespace : "pricetypes"
        };
    },

    methods: {


        update: function () {

            this.is_reload = true;
            this.$store.dispatch('pricetypes/update').then(() => {
                this.page_count = this.$store.getters['pricetypes/items_length'](this.items_per_page);
                this.onChangePage('pricetypes/items');
                this.is_reload = false;
            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
                this.is_reload = false;
            }));

        },

    }

}
</script>

<style scoped>


</style>
