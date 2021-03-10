<template>
    <div>
        <h1 class="text-center">Общие продажи</h1>
        <el-form :inline="true" class="demo-form-inline">
            <el-form-item style="   margin-bottom: 0;" label="Дата:">
                <el-date-picker
                    v-model="date_range"
                    type="daterange"
                    range-separator="-"
                    start-placeholder="Начало"
                    end-placeholder="Конец"
                    :default-value="null"
                >
                </el-date-picker>
            </el-form-item>
            <el-tooltip class="item" effect="dark"
                        content="При отсутствии временных рамок - статистика за весь период"
                        placement="bottom">
                <el-button @click="()=>{
                    this.$refs.chart.update();
                }">Вывести
                </el-button>

            </el-tooltip>


        </el-form>

        <line-chart ref="chart" :start="date_range[0]" :end="date_range[1]"></line-chart>

    </div>
</template>

<script>
import LineChart from './TotalSales.vue'

export default {
    name: "TotalSalesContainer",
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
