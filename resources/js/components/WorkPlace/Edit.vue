<template>
    <div>
        <el-row v-if="is_visible && choosing_state === 0 ">
            <el-col :span="6" :offset="9">
                <el-card class="box-card">

                    <div slot="header">
                        <h2 class="text-center">Рабочее место #{{ item.id }}</h2>
                    </div>
                    <el-form label-position="top">
                        <el-form-item label="Наименование">
                            <el-input type="text" v-model="item.name"></el-input>
                        </el-form-item>
                        <el-form-item label="Склад:">
                            <el-input readonly v-model="item.storage.name" placeholder="">
                                <el-button type="primary" @click="selectingStorage" slot="append"
                                           icon="el-icon-d-arrow-right"></el-button>
                            </el-input>
                        </el-form-item>


                        <el-form-item>
                            <el-button type="primary" @click="submit">Изменить</el-button>
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
import mixin_edit from "../../code/mixins/mixin_edit";
import WorkPlace from "../../code/models/WorkPlace";
import Storage from "../../code/models/Storage";

export default {
    name: "WorkPlaceEdit",
    mixins: [mixin_edit],
    data() {
        return {
            item: new WorkPlace(),

            choosing_state : 0,
            is_visible: false,
            loaded: true,
            errors: [],
            success: true

        };
    },

    beforeCreate() {

        axios.get(`/api/workplaces/${this.$route.params.id}`).then(response => {
            console.log(response)
            this.item = new WorkPlace(response.data.id, response.data.name, new Storage(response.data.storage.id, response.data.storage.name), response.data.last_access, response.data.is_opened);
            this.is_visible = true;

        }).catch((error) => {
            console.log(error);
            this.$router.push({name: 'workplaces.index'});
        })

    },


    methods: {

        submit: function () {
            if (!this.validateFields()) return;
            this.loaded = false;

            axios.patch(`/api/workplaces/${this.item.id}`, this.item.getDataForServer()).then(response => {

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
                this.loaded = true;
                this.$notify({

                    type: 'success',
                    title: 'Успешно!',
                    message: `Элемент с Id = ${this.item.id} успешно изменен!`,
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
            this.showErrors()
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
