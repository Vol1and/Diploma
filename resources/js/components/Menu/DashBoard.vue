<template>

    <div>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <el-row>
                    <el-col :span="5"> <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{opened_workplace_count}}</h3>

                            <p>Открытых рабочих смен</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                    </div></el-col>
                    <el-col :offset="1" :span="5">  <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{last_week_sales_count}}</h3>

                            <p>Продаж за последние 7 дней</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                    </div></el-col>
                    <el-col :offset="1" :span="5"> <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="size">{{most_popular_nomenclature}}</h3>
                            <p>Наиболее популярная позиция:</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                    </div></el-col>
                    <el-col :offset="1" :span="5"><div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{company_balance}} руб.</h3>

                            <p>Баланс предприятия</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <div href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></div>
                    </div></el-col>

                </el-row>
                <el-row>
                    <el-col :span="11">
                        <el-card  shadow="hover" class="box-card">
                            <div slot="header" class="clearfix">
                                <span><h4>График продаж за текущий месяц</h4></span>
                            </div>

                            <total-sales :start="start_date" :end="end_date"></total-sales>

                        </el-card>
                    </el-col>
                    <el-col style="margin-bottom: 20px"  :offset="1"  :span="11">
                        <el-card>
                            <div slot="header" class="clearfix">
                                <span><h4>Данные по рабочим местам</h4></span>
                            </div>
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table style="overflow-y:scroll" class="table table-condensed">
                                    <tbody><tr>
                                        <th style="width: 10px">#</th>
                                        <th>Наименование</th>
                                        <th>Склад</th>
                                        <th >Последнее действие</th>
                                        <th >Пользователь</th>
                                    </tr>

                                    <tr v-for="item in this.$store.getters['workplaces/items']" :key="item.id">
                                        <td>{{item.id}}</td>
                                        <td>{{item.name}}</td>
                                        <td>
                                            {{item.storage.name}}
                                        </td>
                                        <td>
                                            {{item.last_access}}
                                        </td>
                                        <td>
                                            {{item.active_user === null ? "Не открыта" :item.active_user.name}}
                                        </td>

                                    </tr>
                                    </tbody></table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        </el-card>
                        <el-card style="margin-top: 30px">
                            <div slot="header" class="clearfix">
                                <span><h4>Кол-во закупок у контрагентов</h4></span>
                            </div>
                            <agents-cash></agents-cash>
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
import AgentsCash from "../Charts/AgentsCash";
export default {
    name: "DashBoard",
    components: {TotalSales, AgentsCash},
    data() {
        return {

            most_popular_nomenclature: null,
            opened_workplace_count: null,
            last_week_sales_count: null,
            company_balance : null,
            start_date: moment().clone().startOf('month').format('YYYY-MM-DD'),
            end_date: moment().clone().endOf('month').format('YYYY-MM-DD')
        };
    },
    methods: {},
    mounted() {
        this.$store.dispatch("workplaces/update");

        axios.post('/api/dashboard').then((response) =>{

            this.opened_workplace_count = response.data.opened_workplace_count;

            this.last_week_sales_count = response.data.last_week_sales_count;

            this.most_popular_nomenclature = response.data.most_popular_nomenclature;
            this.company_balance = response.data.company_balance;
        })

    }
}
</script>

<style scoped>

.size {
    white-space: nowrap; /* Отменяем перенос текста */
    overflow: hidden; /* Обрезаем содержимое */
    padding: 5px; /* Поля */
    text-overflow: ellipsis; /* Многоточие */
}
.size:hover {
    background: #f0f0f0; /* Цвет фона */
    white-space: normal; /* Обычный перенос текста */
}

</style>
