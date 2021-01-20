<template>
    <div>
        <el-row v-if="is_visible && choosing_state === 0 ">
            <el-col :span="6" :offset="9">
                <el-card class="box-card">

                    <div slot="header">
                        <h2 class="text-center">Номенклатура #{{ item.id }}</h2>
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
                            <el-button type="primary" @click="submit">Изменить</el-button>
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
import mixin_edit from "../../code/mixins/mixin_edit";

export default {
    name: "NomenclatureEdit",
    mixins: [mixin_edit],
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
            this.$router.push({name: 'nomenclature.index'});
        })

    },


    methods: {

        submit: function () {
            if (!this.validateFields()) return;

            this.loaded = false;

            //todo:костыль; поправить отправляемые данные
            axios.patch(`/api/nomenclatures/${this.item.id}`, this.item.getDataForServer()).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Элемент с Id=${this.item.id} успешно изменен!`,
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
