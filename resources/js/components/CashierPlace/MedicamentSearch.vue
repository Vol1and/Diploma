<template>
    <div>
        <el-card class="center-75">
        <el-row v-if="choosing_state === 0 " >

            <el-button style="float: left"  type="danger" icon="el-icon-close" @click="back" ></el-button>
            <h3  v-shortkey="{}" @shortkey="theAction" class="text-center">Поиск номенклатуры по наименованию </h3>

            <el-divider></el-divider>
                <el-form style="width: 100%">
                    <el-form-item style=" width: 100%;  margin-bottom: 0;">
                        <el-input ref="nom_input"  v-model="filter_fields.name_str" autofocus placeholder="Название" @input="filter"></el-input>
                    </el-form-item>
                </el-form>
            <el-divider></el-divider>
            <el-table :data="page_of_items"
                      highlight-current-row
                      @row-dblclick="row_dblclick"
                      @current-change="rowSelected">
                <el-table-column
                    prop="id"
                    label="#"
                    min-width="15"
                >
                </el-table-column>
                <el-table-column
                    prop="name"
                    label="Номенклатура"
                >
                </el-table-column>
                <el-table-column
                    prop="producer.name"
                    label="Производитель"
                    width="400"
                >
                </el-table-column>
            </el-table>


        </el-row>

            <CharacteristicSearch style="margin-bottom: 30px" v-if="choosing_state ===1" @back="characteristic_back" @selected="characteristic_selected" :nomenclature_id="selected_item.id" :storage_id="storage_id" >

            </CharacteristicSearch>


        </el-card>
    </div>
</template>


<script>
import Producer from "../../code/models/Producer";
import Nomenclature from "../../code/models/Nomenclature";
import PriceType from "../../code/models/PriceType";
import mixin_index from "../../code/mixins/mixin_index";
import CharacteristicSearch from "./CharacteristicSearch";

export default {
    name: "MedicamentSearch",
    components: {CharacteristicSearch},
    mixins: [mixin_index],
    props: [
        'storage_id'
    ],
    data: function () {
        return {

            filter_fields: {
                name_str: "",
                producer: {name: ""},
                price_type: {name: ""},

            },
            characteristic_dialog: false,
            choosing_state: 0,
            action_namespace: "nomenclature",
            selected_item: new Nomenclature()

        };
    },

    methods: {
        theAction (event) {
            switch (event.srcKey) {
                case 'down':
                    this.deleteSelected();
                    break;
                case 'up':
                    this.selectingNomenclature();
                    break;
            }
        },
        filterClear: function () {
            this.filter_fields = {
                name_str: ""
            }
        },
        filter() {
            this.filter_state = true;

            setTimeout(() => { axios.get('/api/nomenclature/filter', {
                params: {
                    name: this.filter_fields.name_str
                }
            }).then((response) => {
                this.page_of_items = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => this.page_of_items.push(new Nomenclature(item.id,
                    item.name,
                    new Producer(item.producer.id, item.producer.name, item.producer.country, item.producer.created_at, item.producer.updated_at, item.producer.deleted_at),
                    new PriceType(),
                )))

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })}, 500);

        },
        row_dblclick(selected_item) {
            this.selected_item = selected_item;
            this.choosing_state = 1;
        },
        characteristic_selected(data){
            this.choosing_state = 0;
            this.selected_item.characteristic = data.characteristic;
            this.$emit("selected", {nomenclature: this.selected_item});

        },
        characteristic_back() {
            this.choosing_state = 0;
        },
        back() {
            this.$emit("back");
        }

    }

}
</script>
