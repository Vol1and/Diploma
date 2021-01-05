<template>
    <div v-if="is_visible" class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">

                <div style="margin-bottom: 10px; height: 50px" class=" form-control">
                    <h2 class="text-center center-block">Производитель #{{ item.id }}</h2>
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
                        <button type="submit"
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
import Producer from "../../code/models/Producer";
import mixin_edit from "../../code/mixins/mixin_edit";

export default {
    name: "ProducerEdit",
    mixins: [mixin_edit],
    data() {
        return {
            item: new Producer(),
            is_visible: false,
            loaded: true,
            success: true

        };
    },
    beforeCreate() {
        axios.get(`/api/producers/${this.$route.params.id}`).then(response => {
            this.item = new Producer(response.data.id, response.data.name, response.data.country, response.data.created_at, response.data.updated_at, response.data.deleted_at)

            this.is_visible = true;
        }).catch((errorsor) => {
            console.log("Ошибка!");
            this.$router.push({name: 'producers.index'});
        })


    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;
            this.loaded = false;

            axios.patch(`/api/producers/${this.item.id}`, this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;

                console.log("Ответ получен!");
                this.$notify({
                    group: 'my',
                    type: 'success',
                    title: 'Успешно!',
                    text: `Элемент с Id ${this.item.id} успешно отредактирован!`,

                })
                this.$router.push({name: 'producers.index'});

            }).catch((error) => {
                this.$notify({
                    group: 'my',
                    type: 'success',
                    title: 'Ошибка!',
                    text: "Сообщение ошибки - " + error.response.data.message,
                })
                this.loaded = true;
            })
        },
        validateFields() {
            this.errors = [];
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if (this.item.country.length === 0) this.errors.push("Поле \"Страна\" должно быть заполнено");
            if (this.item.country.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");

            this.showErrors()
            return this.errors.length === 0;
        }


    }

}
</script>

<style scoped>

</style>
