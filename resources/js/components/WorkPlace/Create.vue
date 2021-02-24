<template>
    <div>
        <el-row v-if="choosing_state === 0 ">
            <el-col :span="6" :offset="9">
                <el-card class="box-card">

                    <div slot="header">
                        <h2 class="text-center">Новое рабочее место</h2>
                    </div>
                    <el-form label-position="top">
                        <el-form-item label="Наименование">
                            <el-input type="text" v-model="item.name"></el-input>
                        </el-form-item>
                        <el-form-item label="Производитель:">
                            <el-input readonly v-model="item.storage.name" placeholder="">
                                <el-button type="primary" @click="selectingStorage" slot="append"
                                           icon="el-icon-d-arrow-right"></el-button>
                            </el-input>
                        </el-form-item>


                        <el-form-item>
                            <el-button type="primary" @click="submit">Добавить</el-button>
                            <el-button @click="()=>{this.$router.go(-1)}">Отмена</el-button>
                        </el-form-item>
                    </el-form>
                </el-card>
            </el-col>
        </el-row>
        <storage-choose-component @back="onBack" v-if="choosing_state ===1"
                                  @selected="onSelectedStorage"></storage-choose-component>
    </div>
</template>

<script>
import PriceType from "../../code/models/PriceType";
import mixin_create from "../../code/mixins/mixin_create";
import WorkPlace from "../../code/models/WorkPlace";

export default {
    name: "WorkPlaceCreate",
    mixins: [mixin_create],
    data() {
        return {
            item: new WorkPlace(-1, "", 0),

            loaded: true,
            errors: [],
            success: true,
            choosing_state: 0

        };
    },


    methods: {

        submit: function () {

            if (!this.validateFields()) return;

            this.loaded = false;


            axios.post('/api/workplaces', this.item.getDataForServer()).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Элемент добавлен!',
                    message: `Элемент  успешно добавлен!`,
                })
                this.$router.push({name: 'workplaces.index'});

            }).catch((error) => {
                this.$notify.error({

                    title: 'Ошибка!',
                    message: "Сообщение ошибки - " + error.response.data.message,
                })
                this.loaded = true;
            })
        },
        validateFields() {
            this.errors = [];
            if (this.item.name.length === 0) this.errors.push("Поле \"Наименование\" должно быть заполнено");
            if (this.item.name.length > 255) this.errors.push("Превышен размер поля \"Наименование\"");
            this.showErrors();

            return this.errors.length === 0;
        },
        selectingStorage() {
            this.choosing_state = 1;
        },
        onSelectedStorage(data) {
            this.item.storage = data.storage;
            this.choosing_state = 0;
        },
        onBack() {
            this.choosing_state = 0;
        }

    }

}
</script>

<style scoped>

</style>
