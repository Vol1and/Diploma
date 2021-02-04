<template>
    <el-row class="center-50">

        <h1 class="text-center">Выбор характеристики</h1>
        <h4 class="text-center">Номенклатура: {{ this.item.nomenclature.name }}
            <{{ this.item.nomenclature.producer.name }}></h4>
        <el-row>
            <el-col :span="8">
                <router-link tag="button" class="el-button" :to="{name: 'pricetypes.create'}" style=" float:left ">
                    Добавить
                </router-link>
            </el-col>

            <el-col :span="8" :offset="8">
                <el-button icon="el-icon-refresh" @click="update" :disabled="is_reload" style="float:right;">
                    Обновить
                </el-button>
            </el-col>
        </el-row>

        <el-divider></el-divider>
        <el-table :data="item.characteristics"
                  highlight-current-row
                  @row-dblclick="selected"
                  @current-change="rowSelected">

            <el-table-column
                prop="serial"
                label="Серия"
            >
            </el-table-column>
            <el-table-column
                prop="expiry_date"
                label="Срок"

            >
            </el-table-column>
            <el-table-column
                prop="ware"
                label="Текущий остаток "

            >
            </el-table-column>
        </el-table>
    </el-row>
</template>

<script>
import Nomenclature from "../../code/models/Nomenclature";
import mixin_index from "../../code/mixins/mixin_index";
import Producer from "../../code/models/Producer";
import Characteristic from "../../code/models/Characteristic";
import CharacteristicPrice from "../../code/models/CharacteristicPrice";

export default {
    name: "CharacteristicChooseWithWares",

    mixins: [mixin_index],

    props: {
        nomenclature_id: Number
    },
    data: function () {
        return {
            item: {characteristics: [], nomenclature: new Nomenclature()}
        };
    },
    mounted() {
        this.update();
    },
    methods: {
        rowSelected(id) {

            this.selected_item = id;
        },

        update() {
            console.log(this.nomenclature_id)
            this.is_reload = true;
            axios.get(`/api/characteristic/for-nomenclature/${this.nomenclature_id}`).then((response) => {


                console.log(response.data);
                this.item = {characteristics: [], nomenclature: new Nomenclature()}
                this.item.nomenclature = new Nomenclature(response.data.nomenclature.id,
                    response.data.nomenclature.name,
                    new Producer(response.data.nomenclature.producer.id, response.data.nomenclature.producer.name, response.data.nomenclature.producer.country),
                );

                response.data.characteristics.forEach(row => {

                    this.item.characteristics.push(new Characteristic(
                        row.characteristic_id,
                        row.name,
                        row.serial,
                        row.expiry_date,
                        new CharacteristicPrice(),
                        row.ware
                    ));
                })

                this.is_reload = false;
            });
        },
        selected(selected_item) {
            console.log(selected_item);
            this.$emit("selected", {characteristic: selected_item});
        },
        back() {
            this.$emit("back");
        }
    }
}
</script>

<style scoped>

</style>
