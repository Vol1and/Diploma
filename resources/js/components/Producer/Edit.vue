<template>
    <el-row v-if="is_visible">
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Производитель #{{ item.id }}</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Наименование">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item label="Страна">
                        <el-input type="text" v-model="item.country"></el-input>
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
import Producer from "../../code/models/Producer";
import mixin_edit from "../../code/mixins/mixin_edit";

export default {
    name: "ProducerEdit",
    mixins: [mixin_edit],
    data() {
        return {
            item: new Producer(),
            is_visible: false,
            loaded: true,
            success: true

        };
    },
    beforeCreate() {
        axios.get(`/api/producers/${this.$route.params.id}`).then(response => {
            this.item = new Producer(response.data.id, response.data.name, response.data.country, response.data.created_at, response.data.updated_at, response.data.deleted_at)

            this.is_visible = true;
        }).catch((errorsor) => {
            console.log("Ошибка!");
            this.$router.push({name: 'producers.index'});
        })


    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;
            this.loaded = false;

            axios.patch(`/api/producers/${this.item.id}`, this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;

                console.log("Ответ получен!");
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Элемент с Id=${this.item.id} успешно изменен!`,
                })
                this.$router.push({name: 'producers.index'});

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
            if (this.item.country.length === 0) this.errors.push("Поле \"Страна\" должно быть заполнено");
            if (this.item.country.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");

            this.showErrors()
            return this.errors.length === 0;
        }


    }

}
</script>

<style scoped>

</style>
