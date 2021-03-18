<template>
    <div>
        <el-row v-if="choosing_state === 0" class="center-75">


            <h1 @shortkey="deleteSelected" class="text-center">Остатки складов</h1>

            <el-row>
                <el-col :span="8">
                    <el-dropdown>
                        <el-button>
                            Печать<i class="el-icon-arrow-down el-icon--right"></i>
                        </el-button>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item><a class="print_class"
                                                 :href="'/report/wares/'+filter_fields.nomenclature.id + '/'+ filter_fields.storage.id +'/'">Отчет по фильтрам
                            </a></el-dropdown-item>
                            <el-dropdown-item><a class="print_class"
                                                 :href="'/report/wares/0/0/'">Общий отчет</a></el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>


                </el-col>
                <el-col :span="8">
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

            <el-row v-if="filter_visible">
                <el-divider></el-divider>
                <el-form :inline="true" class="demo-form-inline">
                    <el-form-item style="   margin-bottom: 0;" label="Склад:">
                        <el-input readonly v-model="filter_fields.storage.name" placeholder="">
                            <el-button type="primary" @click="selectingStorage" slot="append"
                                       icon="el-icon-d-arrow-right"></el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item style="   margin-bottom: 0;" label="Номенклатура:">
                        <el-input readonly
                                  v-model="filter_fields.nomenclature.name" placeholder="">
                            <el-button type="primary" @click="selectingNomenclature" slot="append"
                                       icon="el-icon-d-arrow-right">
                            </el-button>
                        </el-input>
                    </el-form-item>

                    <el-form-item style=" float: right;   margin-bottom: 0;">
                        <el-button type="primary" @click="filter">Поиск</el-button>
                    </el-form-item>
                </el-form>
            </el-row>
            <el-divider></el-divider>
            <el-table :data="page_of_items"
                      highlight-current-row

                      @current-change="rowSelected">

                <el-table-column
                    prop="storage.name"
                    label="Склад"

                >
                </el-table-column>
                <el-table-column
                    prop="characteristic.nomenclature.name"
                    label="Номенклатура"

                >
                </el-table-column>

                <el-table-column
                    prop="characteristic.serial"
                    label="Серия"
                >
                </el-table-column>
                <el-table-column
                    prop="characteristic.expiry_date"
                    label="Срок годности"
                >
                </el-table-column>
                <el-table-column
                    prop="ware"
                    label="Остаток"

                >
                </el-table-column>
            </el-table>

        </el-row>
        <storage-choose-component @back="onBack" v-if="choosing_state ===2"
                                  @selected="onSelectedStorage"></storage-choose-component>
        <nomenclature-choose-component @back="onBack" v-if="choosing_state ===1"
                                       @selected="onSelectedNomenclature"></nomenclature-choose-component>
    </div>
</template>


<script>
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "WareIndex",

    mixins: [mixin_index],
    data: function () {
        return {
            action_namespace: "wares",
            filter_fields: {storage: {name: ""}, nomenclature: {name: ""}},
            choosing_state: 0
        };
    },

    methods: {

        update() {
            this.filter_fields = {storage: {name: ""}, nomenclature: {name: ""}};
            axios.get('/api/wares').then((response) => {
                this.page_of_items = response.data;

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                reject()
                //reject(error.response.data.message);
            })
        },
        switch_filter() {
            this.filter_visible = !this.filter_visible;
        },

        selectingStorage() {
            this.choosing_state = 2;
        },
        selectingNomenclature() {
            this.choosing_state = 1;
        },
        onSelectedNomenclature(data) {
            this.filter_fields.nomenclature = data.nomenclature;
            this.choosing_state = 0;
        },
        onSelectedStorage(data) {
            this.filter_fields.storage = data.storage;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        },
        filter() {
            axios.get('/api/wares/filter', {

                params: {
                    storage_id: this.filter_fields.storage.id,
                    nomenclature_id: this.filter_fields.nomenclature.id
                }

            }).then((response) => {

                console.log(response)

                this.page_of_items = response.data;
            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        }

    }

}
</script>

<style scoped>


</style>
