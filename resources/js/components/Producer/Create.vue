<template>
    <div class="row" style="width: 100%">
        <div class="offset-4 col-md-4">
            <div class="offset-2 col-md-8">
                <div v-if="this.errors.length > 0">
                    <ul v-for="error in this.errors">
                        <li>{{ error }}</li>
                    </ul>
                </div>
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
                            <input type="text" name="name" id="name" v-model="fields.name"
                                   class="form-text form-control"/>
                        </div>
                        <div class=" form-group col-md-11">
                            <label class="col-form-label" for="country">Страна</label>
                            <input type="text" name="country" id="country" v-model="fields.country"
                                   class="form-text form-control"/>
                        </div>
                        <button @click="submit()" type="submit"
                                style="display: block;margin-right: auto;margin-left: auto;"
                                class="btn btn-primary center-block">
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
    name: "ProducerCreate",

    data() {
        return {
            fields: {name: "", country : ""},

            loaded: true,
            errors: [],
            success: true

        };
    },


    methods: {

        submit: function () {
            if (this.loaded) {
                this.loaded = false;
                this.errors = [];

                axios.post('/api/producers', this.fields).then(response => {

                    //this.fields = {}; //Clear input fields.
                    this.loaded = true;
                    //console.log(response.data);

                    console.log("Ответ получен!")
                    if (response.status >= 400) {

                        this.errors.push(response.statusText);

                    }
                    else this.$router.push({name: 'producers.index'});
                    // window.location.href = response.data;
                }).catch((error) => {
                    console.log("Ошибка!")
                    this.errors.push(error.response.data.message);
                })
            }
        },
        selectingRoom: function () {
            this.$emit("selectingRoom",);
        },
        selectingGuest: function () {
            this.$emit("selectingGuest");
        },


    }

}
</script>

<style scoped>

</style>
