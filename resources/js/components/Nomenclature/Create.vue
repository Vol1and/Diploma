<template>
    <div>
        <el-row v-if=" choosing_state === 0 ">
            <el-col :span="6" :offset="9">
                <el-card class="box-card">

                    <div slot="header">
                        <h2 class="text-center">Новая номенклатура</h2>
                    </div>
                    <el-form label-position="top">
                        <el-form-item label="Наименование: ">
                            <el-input type="text" v-model="item.name"></el-input>
                        </el-form-item>

                        <el-form-item label="Производитель:">
                            <el-input readonly v-model="item.producer.name" placeholder="">
                                <el-button type="primary" @click="selectingProducer" slot="append"
                                           icon="el-icon-d-arrow-right"></el-button>
                            </el-input>
                        </el-form-item>


                        <el-form-item label="Ценовая группа:">
                            <el-input readonly v-model="item.price_type.name" placeholder="">
                                <el-button type="primary" @click="selectingPriceType" slot="append"
                                           icon="el-icon-d-arrow-right"></el-button>
                            </el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submit">Добавить</el-button>
                            <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                        </el-form-item>

                    </el-form>
                </el-card>
            </el-col>
        </el-row>
        <producer-choose-component @back="onBack" v-if="choosing_state ===1"
                                   @selected="onSelectedProducer"></producer-choose-component>
        <price-type-choose-component @back="onBack" v-if="choosing_state ===2"
                                     @selected="onSelectedPriceType"></price-type-choose-component>
    </div>
</template>

<script>
import Nomenclature from "../../code/models/Nomenclature";

import mixin_create from "../../code/mixins/mixin_create";


export default {
    name: "NomenclatureCreate",
    mixins: [mixin_create],
    data() {
        return {
            item: new Nomenclature(),
            choosing_state: 0,
            loaded: true,
            errors: []

        };
    },

    methods: {

        submit: function () {
            if (!this.validateFields()) return;

            this.loaded = false;

            console.log(this.item.getDataForServer())
            axios.post(`/api/nomenclatures`, this.item.getDataForServer()).then(response => {
                this.$notify({

                    type: 'success',
                    title: 'Элемент добавлен!',
                    message: `Элемент  успешно добавлен!`,
                })
                this.$router.push({name: 'nomenclature.index'});

            }).catch((error) => {
                this.$notify.error({

                    title: 'Ошибка!',
                    message: "Сообщение ошибки - " + error.response.data.message,
                })
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


            this.showErrors()

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
