<template>
    <el-row>
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Новый контрагент</h2>
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
                        <el-button type="primary" @click="submit">Добавить</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
</template>

<script>
import Agent from "../../code/models/Agent";
import mixin_create from "../../code/mixins/mixin_create";

export default {
    name: "AgentCreate",

    mixins : [mixin_create],
    data() {
        return {
            item: new Agent(),

            loaded: true,
            errors: [],
        };
    },

    methods: {

        submit: function () {
            //если валидация не проходит - не продолжаем
            if (!this.validateFields()) return;

            //блокируем доступ к кнопке submit
            this.loaded = false;
            //пост запрос для создания
            axios.post('/api/agents', this.item).then(()=> {

                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Элемент добавлен!',
                    message: `Элемент  успешно добавлен!`,
                })
                //переводим на главную страницу
                this.$router.push({name: 'agents.index'});

            }).catch((error) => {
                this.$notify.error({

                    title: 'Ошибка!',
                    message: "Сообщение ошибки - " + error.response.data.message,
                })
                this.loaded = true;
            })

        },
        //метод валидации свойств объекта
        validateFields() {
            this.errors = [];
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");

            this.showErrors();

            //возвращает булево, в зависимости от того, пуст ли массив ошибок
            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
