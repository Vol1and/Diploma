<template>
    <div class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">
                <div style="margin-bottom: 10px; height: 50px" class=" form-control">
                    <h2 class="text-center center-block">Новый производитель</h2>
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
                            <label class="col-form-label" for="country">Страна</label>
                            <input type="text" name="country" id="country" v-model="item.country"
                                   class="form-text form-control"/>
                        </div>
                        <button  type="submit"
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
import Producer from "../../code/models/Producer";
import mixin_create from "../../code/mixins/mixin_create";

export default {
    name: "ProducerCreate",
    mixins: [mixin_create],
    data() {
        return {
            item: new Producer(-1, "", ""),

            loaded: true,
            success: true

        };
    },

    methods: {


        submit: function () {


            if (!this.validateFields()) return;
            this.loaded = false;
            this.errors = [];

            axios.post('/api/producers', this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;

                this.$notify({
                    group: 'my',
                    type: 'success',
                    title: 'Элемент добавлен!',
                    text: "Элемент успешно добавлен",
                })

                this.$router.push({name: 'producers.index'});
                // window.location.href = response.data;
            }).catch((error) => {
                this.$notify({
                    group: 'my',
                    type: 'success',
                    title: 'Ошибка!',
                    text: "Сообщение ошибки - " + error.response.data.message,
                })
                this.errors.push(error.response.data.message);
            })
        },
        validateFields() {
            this.errors = [];

            console.log("вызов")
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if (this.item.country.length === 0) this.errors.push("Поле \"Страна\" должно быть заполнено");
            if (this.item.country.length > 255) this.errors.push("Превышен размер поля \"Страна\"");


            this.showErrors();
            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
