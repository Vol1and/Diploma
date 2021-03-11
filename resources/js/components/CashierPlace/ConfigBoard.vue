<template>
    <div>
        <el-card v-if="choosing_state === 0" class="center-33">
            <div slot="header">
                <el-row>
                    <el-col :span="8" :offset="8"><h4 class="text-center">Конфигурация</h4></el-col>
                </el-row>
            </div>
            <el-button @click="selectingWorkPlace">Выбор рабочего места</el-button>
        </el-card>

        <workplace-choose-component @back="onBack" v-if="choosing_state ===3"
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
