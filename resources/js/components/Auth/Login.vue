<template>
    <el-row>
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Аутентификация</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Email">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item label="Пароль">
                        <el-input type="password" v-model="item.password"></el-input>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" @click="submit">Логин</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </el-col>
    </el-row>
</template>

<script>
export default {
    name: "Login",
    data: function () {
        return {
            item: {
                name: "",
                password: ""
            }
        };
    },
    computed: {

        //вычисляемое поле - определяет - куда перекинет пользователя после аутентификации
        index_route: function () {
            switch (this.$store.getters["auth/role"]) {
                case 1:
                case 2:
                    return {name: "cashier.index"}
                case 3:
                    return {name: "dashboard"}
                default:
                    return {name: "login"}

            }
        }

    },
    methods: {
        submit() {
            //отправка данных для аутентификации
            this.$store.dispatch('auth/sendLoginRequest', {
                email: this.item.name,
                password: this.item.password
            }).then(() => {
                this.$router.push(this.index_route);
            }).catch((error) => {
                //если статус ошибки 422 - то логин неправильный
                if (error.response.status === 422) {
                    this.$notify.error({
                        title: 'Ошибка!',
                        message: "Вы ввели некорректные данные!",
                    })
                } else this.$notify.error({
                    title: 'Ошибка!',
                    message: "Сообщение ошибки - " + error.response.data.message,
                })
            });
        }
    }
}
</script>

<style scoped>

</style>
