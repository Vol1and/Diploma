<template>

    <div>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <el-row>

                    <el-col :span="5">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3></h3>

                                <p>Кол-во номенклатуры:</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                        </div>

                        <!-- ./col -->

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                        </div>


                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3></h3>

                                <p>Всего агентов:</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                        </div>

                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                        </div>

                    </el-col>
                    <el-col :offset="1" :span="10">
                        <el-card style="margin-right: 30px" shadow="hover" class="box-card">
                            <div slot="header" class="clearfix">
                                <span><h4>График продаж за текущий месяц</h4></span>
                            </div>
                            <total-sales :start="start_date" :end="end_date"></total-sales>
                        </el-card>
                    </el-col>
                </el-row>
            </div>
        </section>


    </div>
</template>

<script>
import TotalSales from "../Charts/TotalSales";
import moment from "moment";

export default {
    name: "DashBoard",
    components: {TotalSales},
    data() {
        return {
            sales_by_month: null,
            start_date: moment().clone().startOf('month').format('YYYY-MM-DD'),
            end_date: moment().clone().endOf('month').format('YYYY-MM-DD')
        };
    },
    methods: {},
    created() {
    }
}
</script>

<style scoped>

</style>
