<template>
    <div>
        <el-row class="center-75">


            <h1 class="text-center">Штрихкоды</h1>

            <el-row>

                <el-col :span="8" >

                    <router-link tag="button" class="el-button" :to="{name: 'barcodes.create'}" style=" float:left ">
                        Добавить
                    </router-link>
                </el-col>
                <el-col :span="8" >
                    <el-row>
                        <el-col :span="8" :offset="8">
                            <el-button icon="el-icon-s-operation" style=" width: 100%" @click="switch_filter()"
                                       v-if="!filter_visible">
                                Фильтры
                            </el-button>
                            <el-button @click="switch_filter()" style="width: 100%" v-else type="danger">Закрыть
                            </el-button>
                        </el-col>
                    </el-row>
                </el-col>
                <el-col :span="8">
                    <el-button icon="el-icon-refresh" @click="update" :disabled="is_reload" style="float:right;">
                        Обновить
                    </el-button>
                </el-col>
            </el-row>
            <el-divider></el-divider>
            <el-table :data="page_of_items"
                      highlight-current-row

                      @current-change="rowSelected">
                <el-table-column
                    prop="nomenclature.name"
                    label="Номенклатура"

                >
                </el-table-column>
                <el-table-column
                    prop="barcode.code"
                    label="Штрихкод"

                >
                </el-table-column>

            </el-table>

        </el-row>
    </div>
</template>


<script>
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "BarCodeIndex",

    mixins: [mixin_index],
    data: function () {
        return {
        };
    },

    methods: {
        update() {
            axios.get('/api/barcodes').then((response) => {
                this.page_of_items = response.data;

            })
        }
    }

}
</script>

<style scoped>


</style>
