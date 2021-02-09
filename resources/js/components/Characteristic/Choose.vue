<template>
    <el-row class="center-90">

        <h1 class="text-center">Выбор характеристики</h1>
        <h4 class="text-center">Номенклатура: {{ this.item.nomenclature.name }}
            <{{ this.item.nomenclature.producer.name }}></h4>
        <el-row>
            <el-col :span="8">
                <el-button  @click="create_dialog = true;" style=" float:left ">
                    Добавить
                </el-button>
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
        </el-table>
        <el-drawer
            :append-to-body="true"
            :visible.sync="create_dialog"
            direction="ltr"
            custom-class="demo-drawer"
            ref="drawer"
        >
            <characteristic-create-component @created="characteristicCreated" :prop_nomenclature_id="nomenclature_id" v-if="create_dialog"
                                                        :nomenclature_id="nomenclature_id"
                                                       ></characteristic-create-component>
        </el-drawer>
    </el-row>
</template>

<script>
import Nomenclature from "../../code/models/Nomenclature";
import mixin_index from "../../code/mixins/mixin_index";
import Producer from "../../code/models/Producer";
import Characteristic from "../../code/models/Characteristic";
import CharacteristicPrice from "../../code/models/CharacteristicPrice";

export default {
    name: "CharacteristicChoose",

    mixins: [mixin_index],

    props: {
        create_dialog: false,
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
                        row.id,
                        row.name,
                        row.serial,
                        row.expiry_date,
                        new CharacteristicPrice(),
                    ));
                })

                this.is_reload = false;
            });
        },
        selected(selected_item) {
            console.log(selected_item);
            this.$emit("selected", {characteristic: selected_item});
        },
        characteristicCreated(){

            this.create_dialog = false;
            this.update();

        },
        back() {
            this.$emit("back");
        }
    }
}
</script>

<style scoped>

</style>
