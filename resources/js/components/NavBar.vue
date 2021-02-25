<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home.index'}">
                Diploma
            </router-link>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li v-if="$store.getters['auth/user'] == null" class="nav-item">
                        <router-link class="nav-link" :to="{name: 'login'}" >Логин</router-link>
                    </li>
                    <li v-else class="nav-item">
                        <a> Вы: {{ $store.getters['auth/user'].name }}</a>
                    </li>



                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped>

</style>
