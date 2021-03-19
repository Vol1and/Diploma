//данный код будет включен во все Index-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
export default {


    data: function () {
        return {

            //булево значение - показывает, видна ли панель с фильтрами поиска
            filter_visible: false,
            //этот булл отвечает за отображение пагинации во время запроса фильтра
            //я посчитал, что данные по фильтру должны отображаться сразу полностью, а не с пагинацией
            //к тому же такая реализация проще
            filter_state: false,

            default_filter_fields: {},

            filter_fields: {},

            filter_namespace: "",

            action_namespace: ""
        };
    },
    methods: {
        getParamsPreset() {
            return {}
        },
        filterClear() {
            this.filter_fields = this.default_filter_fields;
            this.filter_state = false;

        },

        switch_filter() {
            this.filter_fields = _.cloneDeep(this.default_filter_fields);
            this.filter_state = false;
            this.filter_visible = !this.filter_visible;
        },
        filter() {
            this.filter_state = true;

            axios.get(`/api/${this.filter_namespace}/filter`, {
                params: this.getParamsPreset()
            }).then((response) => {

                this.page_of_items = this.$store.getters[`${this.action_namespace}/aggregateData`](response.data);

            }).catch((error) => {

                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        }
    }
}
