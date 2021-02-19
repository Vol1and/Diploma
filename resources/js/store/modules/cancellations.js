import StorageDocument from "../../code/models/StorageDocument";
import StorageDocumentTableRow from "../../code/models/StorageDocumentTableRow";
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




}

// actions - операции-обертки для мутаций - могут быть асинхронными
const actions = {
    //асинхронная операция апдейта
    update(context) {
        return new Promise((resolve, reject) => {
            //запрашивает данные с сервера

            axios.get('/api/storage-documents').then((response) => {
                console.log(response)
                let result = [];

                //console.log(response.data)
                let table_rows = [];
                //оборачиваем каждый элемент пришедших данных в модель модуля
                response.data.forEach(item => {


                    if (item.table_rows !== undefined && item.table_rows.length > 0) item.table_rows.forEach(row => table_rows.push(new StorageDocumentTableRow(row.id, row.nomenclature, row.characteristic, row.count, row.sell_price)));


                    result.push(new StorageDocument(item.id, 3,item.is_set,
                        new Storage(item.source_storage.id, item.source_storage.name),
                        new Storage(),
                        item.date, table_rows,item.comment,item.doc_sum,
                        item.created_at, item.updated_at, item.deleted_at))

                })

                //console.log(result)
                //дергаем мутатор
                context.commit('setItems', result);
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
            axios.post('/api/cancellation-documents', data.fields).then(response => {

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
            axios.delete(`/api/cancellation-documents/${data.id}`).then(response => {

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
