<template>
    <div>
        <div v-if="is_visible && choosing_state === 0 " class="row" style="width: 100%">
            <div class="offset-4 col-md-4">
                <div class="offset-2 col-md-8">
                    <error-component :errors="errors"></error-component>
                    <div style="margin-bottom: 10px; height: 50px" class=" form-control ">
                        <h2 class="text-center center-block">Номенклатура #{{ fields.id }}</h2>
                    </div>
                </div>
                <div class="  row offset-2 col-md-8">
                    <div class="col-md-12 no-padding" style="padding: 0">
                        <form class="form-control" style=":170px; height: 100%"
                              @submit.prevent="submit">

                            <div class=" form-group col-md-11">
                                <label class="col-form-label" for="name">Наименование</label>
                                <input type="text" name="name" id="name" v-model="fields.name"
                                       class="form-text form-control"/>
                            </div>
                            <div class="form-group  col-md-11">
                                <label class="col-form-label" for="guest_id">Производитель</label>
                                <div class="form-inline">
                                    <input type="text" disabled name="days_count" :value="producer_field"
                                           id="producer_id"
                                           style="margin-top: 0" class="form-text form-control col-md-10"/>
                                    <button @click="selectingProducer()" type="button" class="btn  btn-primary">>>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group  col-md-11">
                                <label class="col-form-label" for="guest_id">Ценова группа</label>
                                <div class="form-inline">
                                    <input type="text" disabled name="days_count" :value="price_type_field"
                                           id="guest_id"
                                           style="margin-top: 0" class="form-text form-control col-md-10"/>
                                    <button @click="selectingPriceType()" type="button" class="btn  btn-primary">>>
                                    </button>
                                </div>
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
        <producer-choose-component   @back="onBack" v-if="choosing_state ===1" @selected="onSelectedProducer"></producer-choose-component>
        <price-type-choose-component @back="onBack" v-if="choosing_state ===2" @selected="onSelectedPriceType"></price-type-choose-component>
    </div>
</template>

<script>
export default {
    name: "NomenclatureEdit",

    data() {
        return {
            fields: {id: -1, name: "", producer_id: -1, price_type_id: -1},
            choosing_state: 0,
            is_visible: false,
            loaded: true,
            errors: [],
            success: true,
            producer_field: "",
            price_type_field: ""

        };
    },

    beforeCreate() {

        axios.get(`/api/nomenclatures/${this.$route.params.id}`).then(response => {
            this.fields.id = response.data.id;
            this.fields.name = response.data.name;
            this.fields.producer_id = response.data.producer.id;
            this.fields.price_type_id = response.data.price_type.id;
            this.producer_field = response.data.producer.name;
            this.price_type_field = response.data.price_type.name;
            this.is_visible = true;

        }).catch((error) => {
            console.log("Ошибка!");
            this.$router.push({name: 'nomenclatures.index'});
        })

    },


    methods: {

        submit: function () {
            if (!this.validateFields()) return;

            this.loaded = false;

            axios.patch(`/api/nomenclatures/${this.fields.id}`, this.fields).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;

                console.log("Ответ получен!");
                this.$router.push({name: 'nomenclatures.index'});

            }).catch((error) => {
                console.log("Ошибка!")
                //this.$router.push({name: 'producers.index'});
                this.errors.push(error.response.data.message);
                this.loaded = true;
            })
        },
        validateFields() {
            this.errors = [];
            if (this.fields.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.fields.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if (this.fields.price_type_id < 0) this.errors.push("Ошибка в поле \"Ценовая группа\"");
            if (this.fields.producer_id < 0) this.errors.push("Ошибка в поле \"Производитель\"");


            return this.errors.length === 0;
        },
        selectingProducer() {
            this.choosing_state = 1;
        },
        selectingPriceType() {
            this.choosing_state = 2;
        },
        onSelectedProducer(data) {
            this.fields.producer_id = data.producer.id;
            this.producer_field = data.producer.name;
            this.choosing_state = 0;
        },

        onSelectedPriceType(data) {
            this.fields.price_type_id = data.price_type.id;
            this.price_type_field = data.price_type.name;
            this.choosing_state = 0;
        },
        onBack(){
            this.choosing_state = 0;
        }

    }

}
</script>

<style scoped>

</style>
