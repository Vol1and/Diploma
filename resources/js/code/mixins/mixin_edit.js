//данный код будет включен во все Edit-компоненты (например, ProducerEdit)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
export default {


    data: function () {
        return {

            errors: []

        };
    },
    methods: {

        showErrors() {
            this.errors.forEach(item =>
                this.$message({
                    showClose: true,
                    message: item,
                    type: 'error'
                }));


        }
    }
}
