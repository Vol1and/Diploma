<template>

    <div>
        <el-row>

            <el-col :span="5">
                <el-card body-style="" shadow="hover"  class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4>Продажи за этот месяц</h4></span>
                    </div>
                    <div>
                        <h3> 1000 продаж за месяц!!!!</h3>

                    </div>
                </el-card>
                <el-card style="margin-top: 15px" body-style="" shadow="hover"  class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4>Продажи за этот месяц</h4></span>
                    </div>
                    <div>
                        <h3> 1000 продаж за месяц!!!!</h3>

                    </div>
                </el-card>
                <el-card style="margin-top: 15px" body-style="" shadow="hover"  class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4>Продажи за этот месяц</h4></span>
                    </div>
                    <div>
                        <h3> 1000 продаж за месяц!!!!</h3>

                    </div>
                </el-card>
                <el-card style="margin-top: 15px" body-style="" shadow="hover"  class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4>Продажи за этот месяц</h4></span>
                    </div>
                    <div>
                        <h3> 1000 продаж за месяц!!!!</h3>

                    </div>


                </el-card>
                <el-card style="margin-top: 15px" body-style="" shadow="hover"  class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4>Продажи за этот месяц</h4></span>
                    </div>
                    <div>
                        <h3> 1000 продаж за месяц!!!!</h3>

                    </div>
                </el-card>
            </el-col>
            <el-col :offset="1" :span="18">
                <el-card style="margin-right: 30px" shadow="hover"  class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4>Продажи за этот месяц</h4></span>
                    </div>
                    <total-sales ></total-sales>
                </el-card>
            </el-col>
        </el-row>
        <el-row>

        </el-row>
    </div>
</template>

<script>
import TotalSales from "../Charts/TotalSales";

export default {
    name: "DashBoard",
    components: {TotalSales},
    data() {
        return {
           sales_by_month: null
        };
    },
    methods: {},
    created() {
    }
}
</script>

<style scoped>

</style>
