<template>
<div>
    <router-link :to="{name: 'producers.index'}">Перейти к производителям</router-link>
    <router-view></router-view>
</div>
</template>

<script>
export default {
name: "HomeComponent"

}


</script>

<style scoped>

</style>
