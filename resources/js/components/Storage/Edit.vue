<template>
    <el-row v-if="is_visible">
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Склад #{{ item.id }}</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Наименование">
                        <el-input type="text" v-model="item.name"></el-input>
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
import Storage from "../../code/models/Storage";
import mixin_edit from "../../code/mixins/mixin_edit";

export default {
    name: "StorageEdit",
    mixins: [mixin_edit],
    data() {
        return {
            item: new Storage(),

            is_visible: false,
            loaded: true,

            success: true

        };
    },

    beforeCreate() {

        axios.get(`/api/storages/${this.$route.params.id}`).then(response => {
            this.item = new Storage(response.data.id, response.data.name, response.data.created_at, response.data.updated_at, response.data.deleted_at);
            this.is_visible = true;

        }).catch((error) => {
            console.log("Ошибка!");
            this.$router.push({name: 'storages.index'});
        })

    },


    methods: {

        submit: function () {
            if (!this.validateFields()) return;
            this.loaded = false;

            axios.patch(`/api/storages/${this.item.id}`, this.item).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Элемент с Id=${this.item.id} успешно изменен!`,
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

            this.showErrors()

            return this.errors.length === 0;
        }


    }

}
</script>

<style scoped>

</style>
