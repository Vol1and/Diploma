<template>
    <div class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">
                <error-component :errors="errors"></error-component>
                <div style="margin-bottom: 10px; height: 50px" class=" form-control">
                    <h2 class="text-center center-block">Новый контрагент</h2>
                </div>
            </div>
            <div class="row offset-2 col-md-8">
                <div class="col-md-12 no-padding" style="padding: 0">
                    <form class="form-control" style=":170px; height: 100%"
                          @submit.prevent="submit">

                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="name">Наименование</label>
                            <input type="text" name="name" id="name" v-model="fields.name"
                                   class="form-text form-control"/>
                        </div>
                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="billing">Биллинг</label>
                            <input type="text" name="country" id="billing" v-model="fields.billing"
                                   class="form-text form-control"/>
                        </div>
                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="address">Адрес</label>
                            <input type="text" name="country" id="address" v-model="fields.address"
                                   class="form-text form-control"/>
                        </div>
                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="description">Доп. инфо</label>
                            <input type="text" name="country" id="description" v-model="fields.description"
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
export default {
    name: "AgentsCreate",

    data() {
        return {
            fields: {name: "", billing: "", address: "", description: ""},

            loaded: true,
            errors: [],
            success: true

        };
    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;

            this.loaded = false;


            axios.post('/api/agents', this.fields).then(response => {
                this.loaded = true;
                this.$router.push({name: 'agents.index'});


            }).catch((error) => {
                console.log("Ошибка!")
                this.errors.push(error.response.data.message);
                this.loaded = true;
            })
        },
        validateFields() {
            this.errors = [];
            if (this.fields.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.fields.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");

            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
