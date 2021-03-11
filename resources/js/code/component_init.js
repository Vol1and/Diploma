//здесь происходит первичная инициализация компонентов, которые используются  в vue


import IncomeCreate from "../components/Documents/Income/Create";
import WaresIndex from "../components/Ware/Index"

import Home from "../components/Menu/Home";


Vue.component('IncomeCreate', IncomeCreate.default);
Vue.component('WaresIndex', WaresIndex.default);


Vue.component('producer-choose-component',
    require('../components/Producer/Choose').default);


Vue.component('price-type-choose-component',
    require('../components/PriceType/Choose').default);


Vue.component('storage-choose-component',
    require('../components/Storage/Choose').default);

Vue.component('agent-choose-component',
    require('../components/Agent/Choose').default);


Vue.component('nomenclature-choose-component',
    require('../components/Nomenclature/Choose').default);

Vue.component('characteristic-choose-with-wares-component',
    require('../components/Characteristic/ChooseWithWares').default);

Vue.component('workplace-choose-component',
    require('../components/WorkPlace/Choose').default);


Vue.component('characteristic-choose-component',
    require('../components/Characteristic/Choose').default);

Vue.component('characteristic-create-component',
    require('../components/Characteristic/Create').default);

Vue.component('navbar',
    require('../components/Menu/NavBar').default);

Vue.component('SideBar',
    require('../components/Menu/SideBar').default);

Vue.component('ConfigBoard', require('../components/CashierPlace/ConfigBoard').default)
Vue.component('CharacteristicSearch', require('../components/CashierPlace/CharacteristicSearch').default)
Vue.component('CashInput', require('../components/CashierPlace/CashInput').default)
//Vue.component('CharacteristicForNomenclature',     CharacteristicForNomenclature.default);

Vue.component('HomeComponent', Home.default);
