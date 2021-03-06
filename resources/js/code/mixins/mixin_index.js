//данный код будет включен во все Index-компоненты (например, ProducerIndex)
//хранит данные, которые используются в каждых компонентах
//подробнее почитать можно https://ru.vuejs.org/v2/guide/mixins.html
export default {
    data: function () {
        return {


            //текущая страница пагинации - изначально 1, в зависимости от действий меняется
            current_page: 1,
            //кол-во страниц пагинации - вычисляется в коде при запросе данных
            page_count: 1,
            //массив с итемами - для каждого компонента свой - в него будут занесены данные с сервера
            items: [],
            //этот массив будет хранить элементы текущей страницы пагинации - при изменении страницы - меняется
            //меняется в функции onChangePage
            page_of_items: [],
            //показывает - происходит ли запрос у сервера данных - чтобы заблокировать в этот момент некоторые элементы
            is_reload: false,
            //когда клик по строке таблицы, сюда помещается выбранный объект, выбор происходит в функции rowSelected
            selected_item: -1,

            //сколько элементов будет на одной странице пагинации - можно реинициализировать
            items_per_page: 10,
            //в каждой компоненте используется свой набор запросов или команд в хранилище
            //все они работают по схеме [текущий модуль]/[действие] (например producers/update)
            //чтобы можно было чуть больше унифицировать компоненты, в данную строку будет помещаться значение [текущий модуль]
            //и некоторые методы можно вынести сюда, следовательно, упростить дальнейшую разработку кода
            action_namespace: ""
        };
    },
    //при создании каждого Index-компонента первым делом происходит вызов update-метода - в кажом компоненте она своя
    created() {
        this.update();
    },
    methods: {

        //вызывается при клике по строке
        rowSelected(item) {

            this.selected_item = item;
        },
        // функция - в ней для page_of_items присваивается новый кусок основного массива с элементами - какой кусок - зависит от выбранной страницы
        onChangePage() {

            this.page_of_items =
                //this.$store.getters - тут происходит вызов данных из общего хранилища на ВСЁ клиентское приложение
                this.$store.getters[`${this.action_namespace}/items`]
                    //здесь мы вырезаем из него кусок в зависимости от количества элементов на странице И текущей страницы
                    //ПРИМЕР: страница 3, по 10 элементов на страницу - слайсим начиная от 20(10 * 3-1) до 30(10*3)
                    .slice(this.items_per_page * (this.current_page - 1), (this.items_per_page * this.current_page));
        },
        //по дабл-клику - переходим на строку с изменением выбраного объекта
        toEdit() {

            this.$router.push({name: `${this.action_namespace}.edit`, params: {id: this.selected_item.id}});
        },
        //метод удаления выбранной строки
        deleteSelected() {
            //если строка не выбрана - выходим
            if (this.selected_item.id === undefined) return;

            //модальное окно - подтверждение выбра
            this.$confirm(`Вы действительно хотите удалить элмент с Id=${this.selected_item.id}?`, 'Внимание!', {
                confirmButtonText: 'Удалить',
                cancelButtonText: 'Отмена',
                type: 'warning'
            }).then(() => {
                //в vuex отправляем запрос на удаление - удаляем
                this.$store.dispatch(`${this.action_namespace}/deleteItem`, {id: this.selected_item.id}).then(() => {
                    //сбрасываем выбранный объект
                    this.selected_item = null;
                    //делаем повторный запрос - обновляем данные
                    this.onChangePage();
                    //выводим сообщение об успехе
                    this.$message({
                        type: 'success',
                        title: "Успешно",
                        message: 'Элемент был успешно удален!'
                    });
                }, (reason => {
                    console.log(`Что то пошло не так. Код ответа - ${reason}`)
                }))

            }).catch(() => {
                //если пользователь отменил удаление - выводим
                this.$message({
                    type: 'info',
                    title: 'Отмена',
                    message: 'Удаление было отмненено'
                });
            });


        },


        update: function () {

            this.is_reload = true;
            this.$store.dispatch(`${this.action_namespace}/update`).then(() => {
                this.is_reload = false;
                this.page_count = this.$store.getters[`${this.action_namespace}/items_length`](this.items_per_page);
                this.current_page = 1;
                this.onChangePage();

            }, (reason => {
                console.log(`Что то пошло не так. Код ответа - ${reason}`)
                this.is_reload = false;
            }));

        },
        filterClear() {

        }
    }
}
