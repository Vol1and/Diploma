<template>
    <el-row>
        <el-col :offset="2" :span="20">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Новая характеристика</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Серия">
                        <el-input type="text" v-model="item.serial"></el-input>
                    </el-form-item>

                    <el-form-item label="Срок годности">
                        <el-date-picker format="yyyy/MM/dd"
                        value-format="yyyy/MM/dd" style="width: 100%" type="date" v-model="item.expiry_date"></el-date-picker>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" @click="submit">Добавить</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
</template>

<script>
import mixin_create from "../../code/mixins/mixin_create";
import Characteristic from "../../code/models/Characteristic";

export default {
    name: "CharacteristicCreate",
    mixins: [mixin_create],
    props: [
        "prop_nomenclature_id"
    ],
    data() {
        return {
            item: new Characteristic(-1, "", 0),

            nomenclature_id: this.nomenclature_id = this.$route.params.nomenclature_id,
            loaded: true,
            errors: [],
            success: true

        };
    },
    mounted() {
        this.nomenclature_id = this.$route.params.nomenclature_id;
        if (this.prop_nomenclature_id != null) this.nomenclature_id = this.prop_nomenclature_id;


        if(this.nomenclature_id == null) {
            this.$notify.error({

                title: 'Ошибка!',
                message: "Не указан id номенклатуры!",
            })
            this.loaded = false;
        }
    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;

            this.loaded = false;


            axios.post(`/api/characteristics/${this.nomenclature_id}/create`, this.item).then(response => {
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Элемент добавлен!',
                    message: `Элемент  успешно добавлен!`,
                })
                if(this.prop_nomenclature_id != null )  this.$emit("created");
               // this.$router.push({name: 'characteristics.index'});

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
            if (this.item.serial.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.serial.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            this.showErrors();

            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
