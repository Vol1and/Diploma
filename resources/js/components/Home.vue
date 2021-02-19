<template>
    <div class="center-50">

        <el-row>
            <h1 class="text-center">Главная страница</h1>
            <el-divider></el-divider>
            <el-col :span="6" :offset="1">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span><h4 class="text-center">Нормативно-справочная информация</h4></span>
                    </div>


                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'producers.index'}">Производители
                        </router-link>
                    </div>
                    <div class="text item">
                        <router-link class="el-link--default el-link" :to="{name: 'pricetypes.index'}">Типы цен
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
                        <router-link class="el-link--default el-link" :to="{name: 'cancellation.index'}">Списания
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
                        <span><h3 class="text-center">В админ-панель!</h3></span>
                    </div>


                    <a type="button" class="el-link--default el-link" href="/adm">Перейти!</a>


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
