<template>
    <div class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">
                <error-component :errors="errors"></error-component>
                <div style="margin-bottom: 10px; height: 50px" class=" form-control">
                    <h2 class="text-center center-block">Ценовая группа #{{fields.id}}</h2>
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
                            <label class="col-form-label" for="country">Наценка</label>
                            <input type="number" name="country" id="country" v-model="fields.margin"
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
export default {
    name: "PriceTypeEdit",

    data() {
        return {
            fields: {id: -1, name: "", country: ""},

            loaded: true,
            errors: [],
            success: true

        };
    },
    beforeMount() {

        axios.get(`/api/price-types/${this.$route.params.id}`).then(response => {
            this.fields = response.data;

        }).catch((error) => {
            console.log("Ошибка!");
            this.$router.push({name: 'price-types.index'});
        })

    },


    methods: {

        submit: function () {

            this.loaded = false;
            this.errors = [];

            axios.patch(`/api/price-types/${this.fields.id}`, this.fields).then(response => {

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
        }


    }

}
</script>

<style scoped>

</style>
