<template>

    <div v-if="errors.length > 0" class="alert alert-danger">
        <ul v-for="error in errors">
            <li>{{ error }}</li>
        </ul>
    </div>
</template>

<script>
export default {

    props:[
        "errors"
        ],

name: "Error"
}
</script>

<style scoped>

</style>
