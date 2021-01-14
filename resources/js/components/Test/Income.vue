<template>
    <div>

    <div v-if="choosing_state === 0" class="center-75">
        <h1 class="text-center">Таблица для отправки данных</h1>
        <div class="row" style="margin-bottom: 10px" >

            <div class="col-md-2">
                <label class="col-form-label-lg" style="float: left" for="nomenclature_input">
                    Номенклатура:
                </label>
                <div class="input-group ">
                    <input type="text" disabled name="nomenclature_input" :value="nomenclature.name"
                           id="nomenclature_input"
                           class="form-control "/>

                    <div class="input-group-append">
                        <button @click="selectingNomenclature" type="button" class="btn btn-primary">>></button>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label class="col-form-label-lg" for="serial_input">
                    Серия:
                </label>
                <div class="input-group ">
                    <input id="serial_input" v-model="serial"
                           class=" form-control "/>

                </div>

            </div>

            <div class="col-md-2">
                <label class="col-form-label-lg" for="serial_input">
                    Дата:
                </label>
                <div class="input-group ">
                    <el-date-picker id="expiry_input" v-model="expiry_date" format="yyyy/MM/dd"
                                    value-format="yyyy-MM-dd"/>

                </div>

            </div>


            <div class="col-md-2">
                <label class="col-form-label-lg" for="income_input">
                    Цена закупки:
                </label>
                <div class="input-group ">
                    <input id="income_input" type="number"  class="form-control" v-model="income_price"/>

                </div>


            </div>
            <div class="col-md-2">
                <label class="col-form-label-lg" for="count_input">
                    Количество:
                </label>
                <div class="input-group ">
                    <input id="count_input" type="number"  class="form-control" v-model="count"/>

                </div>

            </div>
            <div class="col-md-2">
                <button @click="add" style="float: right" class="  btn btn-primary">
                    Добавить
                </button>

            </div>


        </div>
        <div class="row">

        </div>

        <table class="table">
            <tr>
                <th>#</th>
                <th>Номенклатуры</th>
                <th>Серия</th>
                <th>Срок годности</th>
                <th>Количество</th>
            </tr>
            <tbody>
            <tr v-for="item in items" class="row-hover" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.nomenclature.name }}</td>
                <td>{{ item.serial }}</td>
                <td>{{ item.expiry_date }}</td>
                <td>{{ item.income_price }}</td>
                <td>{{ item.count }}</td>
            </tr>
            </tbody>
        </table>
        <button @click="send" style="float: right" class="  btn btn-primary">
            Отправить массив
        </button>
    </div>
        <nomenclature-choose-component @back="onBack" v-if="choosing_state === 1"
                                   @selected="onSelectedNomenclature"></nomenclature-choose-component>
    </div>
</template>

<script>
import mixin_index from "../../code/mixins/mixin_index";

export default {
name: "Income",
    mixins: [mixin_index],

    data: function () {
        return {
            nomenclature : {name: ""},
            serial : "",
            expiry_date: "",
            items: [],
            choosing_state : 0,
            income_price: 0,
            count : 0
        };
    },
    methods: {
        selectingNomenclature() {
            this.choosing_state = 1;
        },
        update(){

        },
        onSelectedNomenclature(data) {
            this.nomenclature = data.nomenclature;
            this.choosing_state = 0;
        },
        onBack(data) {
            this.choosing_state = 0;
        },
        add(){

            this.items.push({nomenclature_id: this.nomenclature, serial : this.serial, expiry_date: this.expiry_date, income_price : this.income_price, count: this.income_price});


            console.log(this.items)
        },
        send(){

            axios.post("/api/income", {items : this.items}).then((response) => {


                console.log(response.data);
            });
        }
    }
}
</script>

<style scoped>

</style>
