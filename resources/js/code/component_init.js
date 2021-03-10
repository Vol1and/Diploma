//здесь происходит первичная инициализация компонентов, которые используются  в vue

import NormativeInfo from "../components/Menu/NormativeInfo";

import IncomeCreate from "../components/Documents/Income/Create";
import WaresIndex from "../components/Ware/Index"

import Home from "../components/Home";


Vue.component('IncomeCreate', IncomeCreate.default);
Vue.component('WaresIndex', WaresIndex.default);


Vue.component('NormativeInfo', NormativeInfo.default);

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
    require('../components/NavBar').default);

Vue.component('SideBar',
    require('../components/SideBar').default);


Vue.component('CharacteristicSearch', require('../components/CashierPlace/CharacteristicSearch').default)
Vue.component('CashInput', require('../components/CashierPlace/CashInput').default)
//Vue.component('CharacteristicForNomenclature',     CharacteristicForNomenclature.default);

Vue.component('HomeComponent', Home.default);
