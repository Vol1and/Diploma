<template>
    <div class="center-50">

        <el-row>
            <el-col :span="8">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span>Нормативно-справочная информация</span>
                    </div>




                        <div class="text item">
                            <router-link class="el-link--default el-link" :to="{name: 'producers.index'}">Производители</router-link>
                        </div>
                        <div class="text item">
                            <router-link class="el-link--default el-link" :to="{name: 'pricetypes.index'}">Типы цен</router-link>
                        </div>
                        <div class="text item">
                            <router-link class="el-link--default el-link" :to="{name: 'nomenclature.index'}">Номенклатура</router-link>
                        </div>
                        <div class="text item">
                            <router-link class="el-link--default el-link" :to="{name: 'agents.index'}">Контрагенты</router-link>
                        </div>

                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
    name: "NormativeInfo"
}
</script>
