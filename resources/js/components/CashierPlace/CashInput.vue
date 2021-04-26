<template>

    <div>
        <el-form label-position="right" label-width="150px">
            <el-form-item label="Сумма чека:">

                <el-input style="background: lightgray"  readonly v-model="check_sum" placeholder="">
                    <template slot="append">руб.</template>
                </el-input>
            </el-form-item>
            <el-form-item label="Сумма клиента:">
                <el-input type="number" ref="client_input" value="" autofocus v-model="client_input" placeholder="">
                    <template slot="append">руб.</template>
                </el-input>
            </el-form-item>
            <el-form-item label="Сдача: ">
                <el-input style="background: lightgray"  readonly v-model="change" placeholder="">
                    <template slot="append">руб.</template>
                </el-input>
            </el-form-item>
            <el-button :disabled="change === 'Недостаточно'" @click="selected">Ввести</el-button>
        </el-form>
    </div>
</template>

<script>
export default {
    name: "CashInput",


    props: [
        //в поле хранится сумма созданного чека
        'check_sum'
    ],

    data() {
        return {
            //то, сколько наличных дал клиент
            client_input: 0
        }
    },
    computed: {
        //возвращает либо сдачу (наличные клиента - сумма чека), либо строку "Недостаточно"
        change: function () {
            return this.client_input - this.check_sum >= 0 ? this.client_input - this.check_sum : "Недостаточно"
        }
    },
    mounted() {
        this.client_input = 0;
        //ставим фокус на инпуте с вводом налички
        this.$refs.client_input.focus();
    },
    methods: {

        selected() {
            this.$emit('selected', {change: this.change});
            this.client_input = 0;
        }
    }
}
</script>

<style scoped>

</style>
