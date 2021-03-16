<template>
    <el-row>
        <el-col :span="6" :offset="9">
            <el-card class="box-card">

                <div slot="header">
                    <h2 class="text-center">Аутентификация</h2>
                </div>
                <el-form label-position="top">
                    <el-form-item label="Имя пользователя">
                        <el-input type="text" v-model="item.name"></el-input>
                    </el-form-item>

                    <el-form-item label="Пароль">
                        <el-input type="password"  v-model="item.password"></el-input>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" @click="submit">Логин</el-button>
                        <el-button @click="()=>{this.$router.go(-1)}">Регистрация</el-button>
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
    methods: {
        submit(){


            this.$store.dispatch('auth/sendLoginRequest', {email : this.item.name, password : this.item.password}).then(()=> {
                this.$router.push({name: "home.index"});
            })
        }
    }
}
</script>

<style scoped>

</style>
