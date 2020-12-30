<template>
    <div>
        <div v-if="is_visible && choosing_state === 0 " class="row" style="width: 100%">
            <div class="center-33">
                <div class="">
                    <error-component :errors="errors"></error-component>
                    <div style="margin-bottom: 10px; height: 50px" class=" form-control ">
                        <h2 class="text-center center-block">Номенклатура #{{ item.id }}</h2>
                    </div>
                </div>

                <div class="row " style="padding: 0 15px 15px 15px; height: 100%">
                    <div class="col-md-3 form-control no-padding" style="  height: 100%">

                        <h4 class="text-center">Ссылки</h4>
                        <router-link class=" center-block btn btn-link"
                                     :to="{name: 'nomenclatures.characteristics', params: {id : this.item.id}}">
                            Характеристики
                        </router-link>

                    </div>
                    <div class=" col-md-6 no-padding ">
                        <form class="form-control" style="height: 100%"
                              @submit.prevent="submit">

                            <div class=" form-group col-md-12">
                                <label class="col-form-label" for="name">Наименование</label>
                                <input type="text" name="name" id="name" v-model="item.name"
                                       class="form-text form-control"/>
                            </div>
                            <div class="form-group  col-md-11">
                                <label class="col-form-label" for="guest_id">Производитель</label>
                                <div class="form-inline">
                                    <input type="text" disabled name="days_count" :value="item.producer.name"
                                           id="producer_id"
                                           style="margin-top: 0" class="form-text form-control col-md-10"/>
                                    <button @click="selectingProducer()" type="button" class="btn  btn-primary">>>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group  col-md-11">
                                <label class="col-form-label" for="guest_id">Ценова группа</label>
                                <div class="form-inline">
                                    <input type="text" disabled name="days_count" :value="item.price_type.name"
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
                    <div class="col-md-3 form-control no-padding" style="  height: 100%">

                        <h4 class="text-center">Ссылки</h4>
                        <router-link class=" center-block btn btn-link"
                                     :to="{name: 'nomenclatures.characteristics', params: {id : this.item.id}}">
                            Характеристики
                        </router-link>

                    </div>
                </div>

            </div>

        </div>
        <producer-choose-component @back="onBack" v-if="choosing_state ===1"
                                   @selected="onSelectedProducer"></producer-choose-component>
        <price-type-choose-component @back="onBack" v-if="choosing_state ===2"
                                     @selected="onSelectedPriceType"></price-type-choose-component>
    </div>
</template>

<script>
import Nomenclature from "../../code/models/Nomenclature";

export default {
    name: "NomenclatureEdit",

    data() {
        return {
            item: new Nomenclature(),
            choosing_state: 0,
            is_visible: false,
            loaded: true,
            errors: [],
            success: true,


        };
    },

    beforeCreate() {

        axios.get(`/api/nomenclatures/${this.$route.params.id}`).then(response => {
            this.item = new Nomenclature(response.data.id, response.data.name, response.data.producer, response.data.price_type,
                response.data.created_at, response.data.updated_at, response.data.deleted_at)
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

            //todo:костыль; поправить отправляемые данные
            axios.patch(`/api/nomenclatures/${this.item.id}`, this.item.getDataForServer() ).then(response => {

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
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if (!this.item.price_type.id) this.errors.push("Ошибка в поле \"Ценовая группа\"");
            if (!this.item.producer.id) this.errors.push("Ошибка в поле \"Производитель\"");
            if (this.item.price_type.id <= 0) this.errors.push("Ошибка в поле \"Ценовая группа\"");
            if (this.item.producer.id <= 0) this.errors.push("Ошибка в поле \"Производитель\"");



            return this.errors.length === 0;
        },
        selectingProducer() {
            this.choosing_state = 1;
        },
        selectingPriceType() {
            this.choosing_state = 2;
        },
        onSelectedProducer(data) {
            this.item.producer = data.producer;
            this.choosing_state = 0;
        },

        onSelectedPriceType(data) {
            this.item.price_type = data.price_type;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        }

    }

}
</script>

<style scoped>

</style>
