//эта примесь для компонент, которые реализуют фильтрацию по таблице
export default {


    data: function () {
        return {

            //булево значение - показывает, видна ли панель с фильтрами поиска
            filter_visible: false,
            //этот булл отвечает за отображение пагинации во время запроса фильтра
            //я посчитал, что данные по фильтру должны отображаться сразу полностью, а не с пагинацией
            //к тому же такая реализация проще
            filter_state: false,

            //поле для определения дефолтных значений - его переопределяют непосредственно в компоненте
            default_filter_fields: {},

            //поля фильраций - изначально равно default_filter_fields
            filter_fields: {},

            ///участвует в генерации api-запроса на фильтрацию ---- api/${this.filter_namespace}/filter
            filter_namespace: "",

            //поле имен - определяет модуль vuex, в котором располагаются методы нужной сущности
            action_namespace: ""
        };
    },
    methods: {
        //функция для переопределения - определяет, какие данные будут
        //отправляться гет запросом для фильтрации
        getParamsPreset() {
            return {}
        },
        //очистка фильтра
        filterClear() {
            this.filter_fields = this.default_filter_fields;
            this.filter_state = false;

        },
        //переключение фильтра - при закрытии фильтра filter_fields очищается до дефолтного состояния
        switch_filter() {
            this.filter_fields = _.cloneDeep(this.default_filter_fields);
            this.filter_state = false;
            this.filter_visible = !this.filter_visible;
        },
        // метод фильтрации
        filter() {
            //булево отключает отображение пагинации
            this.filter_state = true;
            //гет запрос - берет данные у сервера по фильтрам
            axios.get(`/api/${this.filter_namespace}/filter`, {
                //в параметрах данные, по которым будет идти фильтрация
                params: this.getParamsPreset()
            }).then((response) => {

                //приходят данные - vuex их аггрегирует, оборачивает в классы
                this.page_of_items = this.$store.getters[`${this.action_namespace}/aggregateData`](response.data);

            }).catch((error) => {

                console.log(`Что то пошло не так. Код ответа - ${error}`)
            })

        }
    }
}
