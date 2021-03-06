import Nomenclature from "../../code/models/Nomenclature";
import Producer from "../../code/models/Producer";
import PriceType from "../../code/models/PriceType";

//содержит переменные, которые будут помещены в модуль хранилища
const state = () => ({
    items: [], //массив с моделями этого модуля
    //when_last_updated: '2000-12-28T00:00:00.000000Z',
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
    aggregateData: state => data => {
        let items = [];
        console.log(data)
        data.forEach(item => items.push(new Nomenclature(item.id,
            item.name,
            new Producer(item.producer.id, item.producer.name, item.producer.country, item.producer.created_at, item.producer.updated_at, item.producer.deleted_at),
            new PriceType(item.price_type.id, item.price_type.name, item.price_type.margin, item.price_type.created_at, item.price_type.updated_at, item.price_type.deleted_at),
            item.created_at,
            item.updated_at,
            item.deleted_at)))


        return items;
    },

}

// actions - операции-обертки для мутаций - могут быть асинхронными
const actions = {

    //асинхронная операция апдейта
    update(context) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.get('/api/nomenclatures').then((response) => {

                //дергаем мутатор
                context.commit('setItems', context.getters.aggregateData(response.data));

                //асинхронный ответ - все ок
                resolve();

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                reject()
                //reject(error.response.data.message);
            })
        });

    },
    deleteItem(context, data) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.delete(`/api/nomenclatures/${data.id}`).then(response => {

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
    },
    //setWhenLastUpdated(state, item) {

    //    state.when_last_updated = item;
    //}
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
