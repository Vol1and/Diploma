//здесь происходит первичная инициализация компонентов, которые используются  в vue

import NormativeInfo from "../components/Menu/NormativeInfo";

import ProducerIndex from "../components/Producer/Index";
import ProducerCreate from "../components/Producer/Create";
import ProducerEdit from "../components/Producer/Edit";


import PriceTypeIndex from "../components/PriceType/Index";
import PriceTypeCreate from "../components/PriceType/Create";
import PriceTypeEdit from "../components/PriceType/Edit";


import AgentIndex from "../components/Agent/Index";
import AgentCreate from "../components/Agent/Create";
import AgentEdit from "../components/Agent/Edit";

import NomenclatureIndex from "../components/Nomenclature/Index";
import NomenclatureCreate from "../components/Nomenclature/Create";
import NomenclatureEdit from "../components/Nomenclature/Edit";

import IncomeCreate from "../components/Documents/Income/Create";

//import CharacteristicForNomenclature from "../components/Characteristic/ForNomenclature";


import Home from "../components/Home";




Vue.component('IncomeCreate',      IncomeCreate.default);

Vue.component('NormativeInfo',      NormativeInfo.default);

Vue.component('ProducerIndex',      ProducerIndex.default);
Vue.component('ProducerCreate',     ProducerCreate.default);
Vue.component('ProducerEdit',       ProducerEdit.default);
Vue.component('producer-choose-component',
    require('../components/Producer/Choose').default);

Vue.component('PriceTypeIndex',     PriceTypeIndex.default);
Vue.component('PriceTypeCreate',    PriceTypeCreate.default);
Vue.component('PriceTypeEdit',      PriceTypeEdit.default);
Vue.component('price-type-choose-component',
    require('../components/PriceType/Choose').default);

Vue.component('AgentIndex',     AgentIndex.default);
Vue.component('AgentCreate',    AgentCreate.default);
Vue.component('AgentEdit',      AgentEdit.default);
Vue.component('agent-choose-component',
    require('../components/Agent/Choose').default);

Vue.component('NomenclatureIndex',    NomenclatureIndex.default);
Vue.component('NomenclatureCreate',   NomenclatureCreate.default);
Vue.component('NomenclatureEdit',     NomenclatureEdit.default);
Vue.component('nomenclature-choose-component',
    require('../components/Nomenclature/Choose').default);


//Vue.component('CharacteristicForNomenclature',     CharacteristicForNomenclature.default);

Vue.component('HomeComponent',      Home.default);
