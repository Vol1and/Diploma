<template>

    <div style=" z-index: 9; position: absolute; height: 100%"  @mouseover="isCollapse =false;" @mouseleave="isCollapse = true">

        <el-menu  style=" position: fixed; height: 100%" class="el-menu-vertical-demo" :collapse="isCollapse">
            <el-submenu  index="1">
                <template slot="title" >
                    <i  class="el-icon-s-tools"></i>
                    <span style="padding-right: 40px" slot="title">Справочная информация</span>
                </template>
                <el-menu-item-group>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'producers.index'}">
                            <el-menu-item index="1-1"> Производители
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'workplaces.index'}">
                            <el-menu-item index="1-2">Рабочие места</el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'nomenclature.index'}">
                            <el-menu-item index="1-3">Номенклатура</el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'agents.index'}">
                            <el-menu-item index="1-4">
                                Контрагенты
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'pricetypes.index'}">

                            <el-menu-item index="1-5">
                                Типы цен
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'storages.index'}">

                            <el-menu-item index="1-6">
                                Склады
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="2">
                <template slot="title">
                    <i class="el-icon-document"></i>
                    <span slot="title">Документы</span>
                </template>
                <el-menu-item-group>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'income.index'}">

                            <el-menu-item index="2-1">
                                Поступления товаров
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'selling.index'}">

                            <el-menu-item index="2-2">
                                Реализации товаров
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'transfers.index'}">

                            <el-menu-item index="2-3">
                                Перемещение товаров
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'cancellations.index'}">

                            <el-menu-item index="2-4">
                                Списания товаров
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">
                    <i class="el-icon-s-data"></i>
                    <span slot="title">Графики</span>
                </template>
                <el-menu-item-group>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'charts.total'}">

                            <el-menu-item index="3-1">
                                Продажи за период
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                    <el-menu-item style="padding: 0">
                        <router-link class="print_class" :to="{name: 'charts.users'}">

                            <el-menu-item index="3-2">
                                Продажи по пользователям
                            </el-menu-item>
                        </router-link>
                    </el-menu-item>
                </el-menu-item-group>
            </el-submenu>
        </el-menu>
    </div>

</template>

<script>
export default {
    name: "SideBar",
    data() {
        return {
            isCollapse: true
        };
    },
    methods: {},

}
</script>

<style scoped>

</style>
