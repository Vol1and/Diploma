<template>
    <div>
        <el-row>
            <el-col :span="20" :offset="2">
                <el-tabs v-model="activeName" @tab-click="handleClick">
                    <el-tab-pane label="График продаж" name="charts.total">
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
                                <el-button v-if="$route.name !== 'charts.total'" @click="()=>{
                $router.push({name: 'charts.total', params: {start: date_range[0], end: date_range[1]}})}">
                                    Вывести
                                </el-button>
                                <el-button v-else @click="()=>{
                $router.push({name: 'charts'})}">
                                    Обнулить
                                </el-button>
                            </el-tooltip>


                        </el-form>
                    </el-tab-pane>
                    <el-tab-pane label="Продажи пользователей" name="charts.users">
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
                            <el-button v-if="$route.name !== 'charts.users'" @click="()=>{
                $router.push({name: 'charts.users', params: {start: date_range[0], end: date_range[1]}})}">
                                Вывести
                            </el-button>
                            <el-button v-else @click="()=>{
                $router.push({name: 'charts'})}">
                                Обнулить
                            </el-button>


                        </el-form>
                    </el-tab-pane>
                </el-tabs>
            </el-col>
        </el-row>
        <router-view></router-view>
    </div>
</template>

<script>
export default {

    name: "ChartContainer",
    data() {
        return {
            activeName: this.$route.name,
            date_range: {}

        };
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        }
    }
}
</script>

<style scoped>

</style>
