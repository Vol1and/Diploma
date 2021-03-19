import Producer from "../../code/models/Producer";


//содержит переменные, которые будут помещены в модуль хранилища
const state = () => ({
    items: [] //массив с моделями этого модуля
})

// геттеры - способ получения информации, которую не имеет смысла хранить в state
const getters = {
    //геттер по массиву с моделями
    items: state => {
        return state.items;
    },
    //узнаем сколько страниц пагинации требуется отобразить
    items_length: state => items_per_page => {

        return Math.ceil(state.items.length / items_per_page);
    },
    aggregateData : state => data=> {
        let result = [];
        //оборачиваем каждый элемент пришедших данных в модель модуля
        data.forEach(item => result.push(new Producer(item.id, item.name, item.country, item.created_at, item.updated_at, item.deleted_at)))

        return result;

    },
}

// actions - операции-обертки для мутаций - могут быть асинхронными
const actions = {

    //асинхронная операция апдейта
    update(context) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.get('/api/producers').then((response) => {

                //дергаем мутатор
                context.commit('setItems', context.getters.aggregateData(response.data));
                //асинхронный ответ - все ок
                resolve();

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                reject(error.response.data.message);
            })
        });

    },
    sendNewItem(context, data) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.post('/api/producers', data.fields).then(response => {

                resolve();

                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
            }).catch((error) => {
                console.log("Ошибка!")
                reject(error.response.data.message);
            })
        });
    },
    deleteItem(context, data) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.delete(`/api/producers/${data.id}`).then(response => {

                context.dispatch('update').then(() => {
                    resolve();
                });


                //todo: на серверной части организовать выброс ошибок, на клиентской - обработку и вывод
            }).catch((error) => {
                console.log("Ошибка!")
                reject(error.response.data.message);
            })
        });
    },


}

// мутации - СИНХРОННЫЕ операции которые меняют данные в хранилищах
const mutations = {
    setItems(state, items) {
        state.items = items;
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
