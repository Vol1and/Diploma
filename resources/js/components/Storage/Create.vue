<template>
    <el-row >
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header" >
                    <h2 class="text-center">Новый склад</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Наименование">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="submit" >Добавить</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
</template>

<script>
import PriceType from "../../code/models/PriceType";
import mixin_create from "../../code/mixins/mixin_create";

export default {
    name: "StorageCreate",
    mixins: [mixin_create],
    data() {
        return {
            item: new PriceType(-1, "", 0),

            loaded: true,
            errors: [],
            success: true

        };
    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;

            this.loaded = false;


            axios.post('/api/storages', this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Элемент добавлен!',
                    message: `Элемент  успешно добавлен!`,
                })
                this.$router.push({name: 'storages.index'});

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

            this.showErrors();

            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
