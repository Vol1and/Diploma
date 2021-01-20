<template>
    <el-row v-if="is_visible">
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Ценовая группа #{{ item.id }}</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Наименование">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item label="Наценка">
                        <el-input type="number" v-model="item.margin"></el-input>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" @click="submit">Изменить</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
</template>

<script>
import PriceType from "../../code/models/PriceType";
import mixin_edit from "../../code/mixins/mixin_edit";

export default {
    name: "PriceTypeEdit",
    mixins: [mixin_edit],
    data() {
        return {
            item: new PriceType(),

            is_visible: false,
            loaded: true,
            errors: [],
            success: true

        };
    },

    beforeCreate() {

        axios.get(`/api/price-types/${this.$route.params.id}`).then(response => {
            this.item = new PriceType(response.data.id, response.data.name, response.data.margin, response.data.created_at, response.data.updated_at, response.data.deleted_at);
            this.is_visible = true;

        }).catch((error) => {
            console.log("Ошибка!");
            this.$router.push({name: 'pricetypes.index'});
        })

    },


    methods: {

        submit: function () {
            this.item.margin = this.item.margin.replace(',', '.');
            console.log(this.item.margin);
            if (!this.validateFields()) return;

            this.item.margin = parseFloat(this.item.margin);
            this.loaded = false;

            axios.patch(`/api/price-types/${this.item.id}`, this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Элемент с Id=${this.item.id} успешно изменен!`,
                })
                this.$router.push({name: 'pricetypes.index'});

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
            if (this.item.margin < 0) this.errors.push("Поле \"Наценка\" не должно быть отрицательным");
            if (this.item.margin > 255) this.errors.push("Превышено максимально допустимое значение поля \"Наценка\"");

            this.showErrors()

            return this.errors.length === 0;
        }


    }

}
</script>

<style scoped>

</style>
