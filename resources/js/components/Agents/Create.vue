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
export default {
    name: "AgentsCreate",

    data() {
        return {
            item: {name: "", billing: "", address: "", description: ""},

            loaded: true,
            errors: [],
            success: true

        };
    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;

            this.loaded = false;


            axios.post('/api/agents', this.fields).then(response => {
                this.loaded = true;
                this.$router.push({name: 'agents.index'});


            }).catch((error) => {
                console.log("Ошибка!")
                this.errors.push(error.response.data.message);
                this.loaded = true;
            })
        },
        validateFields() {
            this.errors = [];
            if (this.fields.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.fields.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");

            return this.errors.length === 0;
        }

    }

}
</script>

<style scoped>

</style>
