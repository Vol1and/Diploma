<template>
    <el-row v-if="is_visible">
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Контрагент #{{ item.id }}</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Наименование: ">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item label="Биллинг: ">
                        <el-input type="textarea" autosize v-model="item.billing"></el-input>
                    </el-form-item>
                    <el-form-item label="Адрес: ">
                        <el-input type="textarea" autosize v-model="item.address"></el-input>
                    </el-form-item>

                    <el-form-item label="Дополнительная информация: ">
                        <el-input type="textarea" autosize v-model="item.description"></el-input>
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
import Agent from "../../code/models/Agent";
import mixin_edit from "../../code/mixins/mixin_edit";

export default {
    name: "AgentEdit",

    mixins: [mixin_edit],

    data() {
        return {
            item: new Agent(),
            is_visible: false,
            loaded: true,
            errors: [],
            success: true

        };
    },

    beforeCreate() {

        axios.get(`/api/agents/${this.$route.params.id}`).then(response => {
            this.item =
                new Agent(
                    response.data.id,
                    response.data.name,
                    response.data.billing,
                    response.data.address,
                    response.data.description,
                    response.data.created_at,
                    response.data.updated_at,
                    response.data.deleted_at);

            this.is_visible = true;

        }).catch((error) => {
            this.$notify.error({

                title: 'Ошибка!',
                message: "Сообщение ошибки - " + error.response.data.message,
            })
            this.$router.push({name: 'agents.index'});
        })

    },


    methods: {

        submit: function () {
            if (!this.validateFields()) return;

            this.loaded = false;

            axios.patch(`/api/agents/${this.item.id}`, this.item).then(() => {

                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Элемент с Id=${this.item.id} успешно изменен!`,
                })
                this.$router.push({name: 'agents.index'});

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

            this.showErrors();

            return this.errors.length === 0;
        }


    }

}
</script>

<style scoped>

</style>
