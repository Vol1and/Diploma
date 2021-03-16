<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <router-link class="navbar-brand" :to="{name: 'home.index'}">
                Diploma
            </router-link>

        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li v-if="$store.getters['auth/user'] == null" class="nav-item">
                        <router-link class="nav-link" :to="{name: 'login'}">Логин</router-link>
                    </li>
                    <el-dropdown v-else :command="logout">
                        <span class="el-dropdown-link">
                           Вы: {{ $store.getters['auth/user'].name }}<i class="el-icon-arrow-down el-icon--right"></i>
                        </span>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item><el-button type="text" @click="logout">Выйти</el-button></el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>


                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavBar",
    methods: {

        logout: function () {
            this.$store.dispatch("auth/sendLogoutRequest").then(()=>{
                this.$router.push({name: "login"});
            })

        },

    },
    created() {
        if (this.$route.meta.requiresAuth && !this.$store.getters["auth/isAuthenticated"]) {
            this.$router.push({name: "login"})
        }
        if (app.$store.getters["auth/role"] < this.$route.meta.access_rate) this.$router.push({name: "home"})

    }
}
</script>

<style scoped>

</style>
