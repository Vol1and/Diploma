<template>
    <div>
        <h1 class="text-center">Статистика контрагентов</h1>
        <line-chart ref="chart"></line-chart>

    </div>
</template>

<script>
import LineChart from './AgentsCash.vue'

export default {
    name: "AgentsCashContainer",
    components: {
        LineChart
    },
    data() {
        return {
            activeName: this.$route.name,
            date_range: {}

        };
    },
}
</script>

<style scoped>

</style>
