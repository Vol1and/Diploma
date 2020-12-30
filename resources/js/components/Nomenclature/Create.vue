<template>
    <div>
        <div v-if="choosing_state === 0 " class="row" style="width: 100%">
            <div class="offset-4 col-md-4">
                <div class="offset-2 col-md-8">
                    <error-component :errors="errors"></error-component>
                    <div style="margin-bottom: 10px; height: 50px" class=" form-control ">
                        <h2 class="text-center center-block">Новая номенклатура</h2>
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
                                    <input type="text" disabled name="days_count" :value="fields.producer.name"
                                           id="producer_id"
                                           style="margin-top: 0" class="form-text form-control col-md-10"/>
                                    <button @click="selectingProducer()" type="button" class="btn  btn-primary">>>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group  col-md-11">
                                <label class="col-form-label" for="guest_id">Ценова группа</label>
                                <div class="form-inline">
                                    <input type="text" disabled name="days_count" :value="fields.price_type.name"
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
                                Записать
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
    name: "NomenclatureCreate",

    data() {
        return {
            fields: {name: "", producer: {id: null, name : ""}, price_type: {id: null, name : ""}},
            choosing_state: 0,
            loaded: true,
            errors: []

        };
    },

    methods: {

        submit: function () {
            if (!this.validateFields()) return;

            this.loaded = false;

            axios.post(`/api/nomenclatures`, this.fields).then(response => {

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
            if (!this.fields.price_type.id) this.errors.push("Ошибка в поле \"Ценовая группа\"");
            if (!this.fields.producer.id) this.errors.push("Ошибка в поле \"Производитель\"");


            return this.errors.length === 0;
        },
        selectingProducer() {
            this.choosing_state = 1;
        },
        selectingPriceType() {
            this.choosing_state = 2;
        },
        onSelectedProducer(data) {
            this.fields.producer = data.producer;
            this.choosing_state = 0;
        },

        onSelectedPriceType(data) {
            this.fields.price_type = data.price_type;
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
