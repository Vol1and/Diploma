<template>
    <div class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">
                <error-component :errors="errors"></error-component>
                <div style="margin-bottom: 10px; height: 50px" class=" form-control">
                    <h2 class="text-center center-block">Новая ценовая группа</h2>
                </div>
            </div>
            <div class="row offset-2 col-md-8">
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
                            Добавить
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
    name: "PriceTypeCreate",

    data() {
        return {
            item: new PriceType(),

            loaded: true,
            errors: [],
            success: true

        };
    },


    methods: {

        submit: function () {

            if(!this.validateFields()) return;

            this.loaded = false;


            axios.post('/api/price-types', this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                //console.log(response.data);

                console.log("Ответ получен!")
                if (response.status >= 400) {

                    this.errors.push(response.statusText);

                } else this.$router.push({name: 'price-types.index'});
                // window.location.href = response.data;
            }).catch((error) => {
                console.log("Ошибка!")
                this.errors.push(error.response.data.message);
                this.loaded = true;
            })
        },
        validateFields(){
            this.errors = [];
            if(this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if(this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if(this.item.margin < 0) this.errors.push("Поле \"Наценка\" не должно быть отрицательным");
            if(this.item.margin > 255) this.errors.push("Превышено максимально допустимое значение поля \"Наценка\"");


            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
