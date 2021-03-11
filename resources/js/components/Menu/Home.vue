<template>
    <div class="center-50">

        <el-row>
            <h1 class="text-center">Главная страница</h1>
            <el-divider></el-divider>
            <el-col :span="6" :offset="1">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4 class="text-center">НСИ</h4></span>
                    </div>


                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'producers.index'}">Производители
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'workplaces.index'}">Рабочие места
                        </router-link>
                    </div>

                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'nomenclature.index'}">Номенклатура
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'agents.index'}">Контрагенты
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'pricetypes.index'}">Типы цен
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'storages.index'}">Склады
                        </router-link>
                    </div>

                </el-card>
            </el-col>
            <el-col :span="6" :offset="2">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h3 class="text-center">Документы</h3></span>
                    </div>

                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'cashier.index'}">Рабочее место кассира
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'transfers.index'}">Перемещения
                            товаров
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'income.index'}">Поступления
                            товаров
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'selling.index'}">Реализации
                            товаров
                        </router-link>
                    </div>

                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'cancellations.index'}">Списания
                            товаров
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'wares.index'}">Остатки товаров
                        </router-link>
                    </div>
                </el-card>
            </el-col>
            <el-col :span="6" :offset="2">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h3 class="text-center">Статистика</h3></span>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'charts'}">Графики
                        </router-link>
                    </div>
                    <!--<div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'charts.total'}">График продаж
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'charts.users'}">Продажи по пользователям
                        </router-link>
                    </div> -->
                </el-card>
            </el-col>
        </el-row>


    </div>
</template>

<script>
export default {
    name: "HomeComponent"

}


</script>

<style scoped>

</style>
