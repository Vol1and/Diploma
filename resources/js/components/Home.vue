<template>
<div class="center-50">
    <h1 class="text-center">Это главная страница</h1>
    <router-link :to="{name: 'producers.index'}">Перейти к производителям</router-link>
</div>
</template>

<script>
export default {
name: "HomeComponent"

}


</script>

<style scoped>

</style>
