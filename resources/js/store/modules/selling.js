import FinanceDocument from "../../code/models/FinanceDocument";
import FinanceDocumentTableRow from "../../code/models/FinanceDocumentTableRow";
import Agent from "../../code/models/Agent";
import Storage from "../../code/models/Storage";
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
        let items = [];

        data.forEach(item => {
            let table_rows = [];

            if (item.table_rows !== undefined && item.table_rows.length > 0) item.table_rows.forEach(row => table_rows.push(new FinanceDocumentTableRow(row.id, row.nomenclature, row.characteristic, row.count, row.income_price, row.sell_price)));


            items.push(new FinanceDocument(item.id, 2,item.is_set,
                new Agent(1),
                new Storage(item.storage.id, item.storage.name),

                item.date, table_rows,null, item.comment,item.doc_sum,
                item.created_at, item.updated_at, item.deleted_at))
        })
        return items;
    },

}

// actions - операции-обертки для мутаций - могут быть асинхронными
const actions = {

    //асинхронная операция апдейта
    update(context) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.get('/api/sellings').then((response) => {

                //дергаем мутатор
                context.commit('setItems', context.getters.aggregateData(response.data));
                //асинхронный ответ - все ок
                resolve();

            }).catch((error) => {
                //если не ок - асинхронный ответ с кодом ошибки

                console.log(error)
                //reject(error.response.data.message);
                reject();
            })
        });

    },
    sendNewItem(context, data) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.post('/api/selling-documents', data.fields).then(response => {

                resolve();

            }).catch((error) => {
                console.log("Ошибка!")
                reject(error.response.data.message);
            })
        });


    },
    deleteItem(context, data) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера
            axios.delete(`/api/selling-documents/${data.id}`).then(response => {

                context.dispatch('update').then(() => {
                    resolve();
                });


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
