<template>
    <div>


        <workplace-choose-component @back="onBack"
                                    @selected="onSelectedWorkPlace">
        </workplace-choose-component>
    </div>
</template>

<script>
export default {
    name: "ConfigBoard",
    data: function () {
        return {

            choosing_state: 0,

        }
    },

    methods: {
        selectingWorkPlace() {
            this.choosing_state = 3;
        },
        onSelectedWorkPlace(data) {
            console.log(data)
            this.$store.dispatch("setWorkplace", {workplace: data.workplace}).then(()=> {
                this.choosing_state = 0;
            })
            this.$emit("selected");

        },
        onBack() {
            this.choosing_state = 0;
        },
    }
}
</script>

<style scoped>

</style>
