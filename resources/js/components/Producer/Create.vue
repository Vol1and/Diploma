<template>
    <el-row>
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Новый производитель</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Наименование">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item label="Страна">
                        <el-input type="text" v-model="item.country"></el-input>
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
import Producer from "../../code/models/Producer";
import mixin_create from "../../code/mixins/mixin_create";

export default {
    name: "ProducerCreate",
    mixins: [mixin_create],
    data() {
        return {
            item: new Producer(-1, "", ""),

            loaded: true,
            success: true

        };
    },

    methods: {


        submit: function () {


            if (!this.validateFields()) return;
            this.loaded = false;
            this.errors = [];

            axios.post('/api/producers', this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;

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

            console.log("вызов")
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            if (this.item.country.length === 0) this.errors.push("Поле \"Страна\" должно быть заполнено");
            if (this.item.country.length > 255) this.errors.push("Превышен размер поля \"Страна\"");


            this.showErrors();
            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
