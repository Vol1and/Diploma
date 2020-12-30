<template>
    <div v-if="is_visible" class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">
                <error-component :errors="errors"></error-component>
                <div style="margin-bottom: 10px; height: 50px" class=" form-control ">
                    <h2 class="text-center center-block">Ценовая группа #{{ item.id }}</h2>
                </div>
            </div>
            <div class="  row offset-2 col-md-8">
                <div class="col-md-12 no-padding" style="padding: 0">
                    <form class="form-control" style=":170px; height: 100%"
                          @submit.prevent="submit">

                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="name">Наименование</label>
                            <input type="text" name="name" id="name" v-model="item.name"
                                   class="form-text form-control"/>
                        </div>
                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="country">Наценка</label>
                            <input type="number" name="country" id="country" v-model="item.margin"
                                   class="form-text form-control"/>
                        </div>
                        <button @click="submit()" type="submit"
                                style="display: block;margin-right: auto;margin-left: auto;"
                                class="btn btn-primary center-block"
                                :disabled="loaded === false">
                            Изменить
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import PriceType from "../../code/models/PriceType";

export default {
    name: "PriceTypeEdit",

    data() {
        return {
            item: new PriceType(),

            is_visible: false,
            loaded: true,
            errors: [],
            success: true

        };
    },

    beforeCreate() {

        axios.get(`/api/price-types/${this.$route.params.id}`).then(response => {
            this.item = new PriceType(response.data.id, response.data.name, response.data.margin, response.data.created_at, response.data.updated_at, response.data.deleted_at);
            this.is_visible = true;

        }).catch((error) => {
            console.log("Ошибка!");
            this.$router.push({name: 'price-types.index'});
        })

    },


    methods: {

        submit: function () {
            this.item.margin = this.item.margin.replace(',', '.');
            console.log(this.item.margin);
            if (!this.validateFields()) return;

            this.item.margin = parseFloat(this.item.margin);
            this.loaded = false;

            axios.patch(`/api/price-types/${this.item.id}`, this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;

                console.log("Ответ получен!");
                this.$router.push({name: 'price-types.index'});

                //if (response.status >= 400) {

                //    this.errors.push(response.statusText);

                //} else
            }).catch((error) => {
                console.log("Ошибка!")
                //this.$router.push({name: 'producers.index'});
                this.errors.push(error.response.data.message);
                this.loaded = true;
            })
        },
        validateFields() {
            this.errors = [];
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if (this.item.margin < 0) this.errors.push("Поле \"Наценка\" не должно быть отрицательным");
            if (this.item.margin > 255) this.errors.push("Превышено максимально допустимое значение поля \"Наценка\"");


            return this.errors.length === 0;
        }


    }

}
</script>

<style scoped>

</style>
