import Nomenclature from "../../code/models/Nomenclature";
import Producer from "../../code/models/Producer";
import PriceType from "../../code/models/PriceType";

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
    //логика для того чтобы узнать, были ли данные изменены на сервере
//   last_updated: state => {
//       return state.items.sort(function(a, b) {
//           var keyA = new Date(a.updated_at),
//               keyB = new Date(b.updated_at);
//           return keyA > keyB ? -1 : keyB > keyA ? 1 : 0;
//       })[0];
//   },

}

// actions - операции-обертки для мутаций - могут быть асинхронными
const actions = {
    //асинхронная операция апдейта
    update(context) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.get('/api/nomenclatures').then((response) => {

                let result = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => result.push(new Nomenclature(item.id,
                    item.name,
                    new Producer(item.producer.id, item.producer.name, item.producer.country, item.producer.created_at, item.producer.updated_at, item.producer.deleted_at),
                    new PriceType(item.price_type.id, item.price_type.name, item.price_type.margin, item.price_type.created_at, item.price_type.updated_at, item.price_type.deleted_at),
                    item.created_at,
                    item.updated_at,
                    item.deleted_at)))

                //дергаем мутатор
                context.commit('setItems', result);
                //асинхронный ответ - все ок
                resolve();

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки
                reject(error.response.data.message);
            })
        });

    }
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
