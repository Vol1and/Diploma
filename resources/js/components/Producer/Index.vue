<template>

    <el-row v-shortkey="['del']" @shortkey="deleteSelected" class="center-75">
        <v-dialog/>

        <h1 class="text-center">Производители</h1>

        <el-row>
            <el-col :span="8">
                    <router-link tag="button" class="el-button" :to="{name: 'producers.create'}" style=" float:left ">
                        Добавить
                    </router-link>
            </el-col>
            <el-col justify="center" :span="8">
                <el-col :span="8" :offset="8">
                    <el-button icon="el-icon-s-operation"  style="width: 100%" @click="switch_filter()" v-if="!filter_visible">
                        Фильтры
                    </el-button>
                    <el-button @click="switch_filter()" style="width: 100%" v-else type="danger">Закрыть</el-button>
                </el-col>

            </el-col>

            <el-col :span="8">
                <el-button icon="el-icon-refresh" @click="update" :disabled="is_reload" style="float:right;">
                    Обновить
                </el-button>
            </el-col>
        </el-row>

        <el-row v-if="filter_visible">
            <el-divider ></el-divider>
            <el-form :inline="true" class="demo-form-inline">
                <el-form-item   style="   margin-bottom: 0;"  label="Название:">
                    <el-input v-model="filter_fields.name_str"  placeholder="Название"></el-input>
                </el-form-item>
                <el-form-item  style="   margin-bottom: 0;"  label="Страна:">
                    <el-input v-model="filter_fields.country_str" placeholder="Страна"></el-input>
                </el-form-item>
                <el-form-item  style="   margin-bottom: 0;" >
                    <el-button type="primary" @click="filter">Поиск</el-button>
                </el-form-item>
            </el-form>

        </el-row>
        <el-divider></el-divider>
        <el-table :data="page_of_items"
                  highlight-current-row
                  @row-dblclick="toEdit"
                  @current-change="rowSelected">
            <el-table-column
                prop="id"
                label="#"
                min-width="15"
            >
            </el-table-column>
            <el-table-column
                prop="name"
                label="Наименование"
            >
            </el-table-column>
            <el-table-column
                prop="country"
                label="Страна"
                width="150"
            >
            </el-table-column>
        </el-table>
        <div v-if="!filter_state" class="centered">
            <!--            <jw-pagination :items="items" @changePage="onChangePage"></jw-pagination>-->

            <el-pagination
                height="250"
                @current-change="onChangePage"
                :current-page.sync="current_page"
                :page-size="items_per_page"
                layout="prev, pager, next, jumper"
                :page-count="page_count"
            >
            </el-pagination>
        </div>
    </el-row>
</template>


<script>
import Producer from "../../code/models/Producer";
import mixin_index from "../../code/mixins/mixin_index";

export default {
    name: "ProducerIndex",

    mixins: [mixin_index],
    data: function () {
        return {

            filter_fields: {
                name_str: "",
                country_str: "",

            },
            //читать об этом в mixin_index
            action_namespace: "producers"
        };
    },

    methods: {

        update: function () {
            this.filter_state = false;
            this.filter_fields.country_str = this.filter_fields.name_str = ""
            this.$store.dispatch('producers/update').then(() => {
                this.page_count = this.$store.getters['producers/items_length'](this.items_per_page);
                this.onChangePage(1);
            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
            }))


        },

        filter() {
            this.filter_state = true;
            axios.get('/api/producer/filter', {
                params: {
                    name: this.filter_fields.name_str,
                    country: this.filter_fields.country_str
                }
            }).then((response) => {
                this.page_of_items = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => this.page_of_items.push(new Producer(item.id, item.name, item.country, item.created_at, item.updated_at, item.deleted_at)))

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        },

        deleteSelected() {
            console.log(`удалится элемент с id ${this.selected_item}`)
            //this.$modal.show('dialog', {
            //    title: 'Вы уверены',
            //    text: 'Удалить выбранный объект?',
            //    buttons: [
            //        {
            //            title: 'Да',
            //            handler: () => {
            //                axios.delete(`/api/producers/${this.selected_item.id}`).then((response) => {
//
            //                    this.update()
            //                    this.$notify({
            //                        group: 'my',
            //                        type: 'success',
            //                        title: 'Успешно!',
            //                        text: `Элемент с Id = ${this.selected_item.id} успешно удален!`,
//
            //                    })
//
            //                }).catch((error) => {
            //                    //если не ок - асинхронный ответ с кодом ошибки
            //                    console.log(`Что то пошло не так. Ошибка - ${error}`)
            //                })
//
            //                this.$modal.hide('dialog')
            //            }
            //        },
            //        {
            //            title: 'Нет',
            //            handler: () => {
//
            //                this.$modal.hide('dialog')
            //            }
            //        }
            //    ]
            //})
        }

    }

}
</script>

<style scoped>


</style>
