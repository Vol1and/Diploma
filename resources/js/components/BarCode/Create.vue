<template>
    <div>
    <el-row v-if="choosing_state === 0">
        <el-col :offset="7" :span="10">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Новый штрихкод</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item style="   margin-bottom: 0;" label="Номенклатура:">
                        <el-input readonly
                                  v-model="item.nomenclature.name" placeholder="">
                            <el-button type="primary" @click="selectingNomenclature" slot="append"
                                       icon="el-icon-d-arrow-right">
                            </el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item label="Штрихкод">
                        <el-input type="text" v-model="item.barcode"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="submit">Добавить</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
    <nomenclature-choose-component @back="onBack" v-if="choosing_state ===1"
                                   @selected="onSelectedNomenclature"></nomenclature-choose-component>
    </div>
</template>

<script>
import mixin_create from "../../code/mixins/mixin_create";

export default {
    name: "CharacteristicCreate",
    mixins: [mixin_create],

    data() {
        return {
            item: {barcode : "" , nomenclature: {id: null, name: ""}},
            //поле блокирует доступ к кнопке submit
            loaded: true,
            success: true,
            choosing_state : 0

        };
    },

    methods: {

        submit: function () {

            if (!this.validateFields()) return;

            this.loaded = false;


            axios.post(`/api/barcodes`, {barcode: this.item.barcode, nomenclature_id : this.item.nomenclature.id}).then(response => {
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Элемент добавлен!',
                    message: `Элемент  успешно добавлен!`,
                })
                this.$router.push({name: "barcodes.index"})
            }).catch((error) => {
                this.$notify.error({

                    title: 'Ошибка!',
                    message: "Сообщение ошибки - " + error.response.data.message,
                })
                this.loaded = true;
            })
        },
        selectingNomenclature() {
            this.choosing_state = 1;
        },
        onSelectedNomenclature(data) {
            this.item.nomenclature = data.nomenclature;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        },
        validateFields() {
            this.errors = [];
            if (this.item.barcode.length < 8 || this.item.barcode.length > 20) this.errors.push("Поле \"Штрихкод\" недопустимого размера");
            this.showErrors();
            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
