<template>

    <div>
        <div class="row">
            <!--            <button @click="toCreate" style=" float:left " class="btn btn-in-bar  btn-primary">Добавить</button>-->

            <!--            <button @click="update"  v-if="!is_reload" style="float:right;" class=" btn-in-bar btn btn-primary">Обновить </button>-->
            <!--            <button disabled v-if="is_reload" style="float:right;" class=" btn-in-bar btn btn-danger"> Обновление...</button>-->
        </div>

        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Название</th>
            </tr>
            <tbody>
            <tr v-for="item in pageOfItems">
                <td>{{ item.id }}</td>
                <td>{{ item.name}}</td>
            </tr>
            </tbody>
        </table>
        <div class="centered">
            <jw-pagination :items="items" @changePage="onChangePage"></jw-pagination>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProducerIndex",

    data: function () {
        return {


            items: [],
            pageOfItems: [],
            is_reload: false,
        };
    },
    mounted() {
        this.update();
    },
    methods: {


        update: function () {
            axios.get('api/producers/getTable').then((response) => {
                this.is_reload = true;

                this.items = response.data;

                this.is_reload = false;
            });
        },
        onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
        }

    }

}
</script>

<style scoped>


</style>
