
import NormativeInfo from "../components/Menu/NormativeInfo";
import ProducerIndex from "../components/Producer/Index";
import ProducerCreate from "../components/Producer/Create";
import ProducerEdit from "../components/Producer/Edit";

import AgentIndex from "../components/Agent/Index";
import AgentCreate from "../components/Agent/Create";
import AgentEdit from "../components/Agent/Edit";

import PriceTypeIndex from "../components/PriceType/Index";
import PriceTypeCreate from "../components/PriceType/Create";
import PriceTypeEdit from "../components/PriceType/Edit";

import NomenclatureIndex from "../components/Nomenclature/Index";
import NomenclatureCreate from "../components/Nomenclature/Create";
import NomenclatureEdit from "../components/Nomenclature/Edit";


import IncomeCreate from "../components/Documents/Income/Create";
import CharacteristicForNomenclature from "../components/Characteristic/ForNomenclature";

import Test from "../components/Test/Income"

import Home from "../components/Home";

import AdminMain from "../components/Admin/Main";

const routes = [
    { path: '/info',name: "menu.info", component: NormativeInfo },


    { path: '/producers',name: "producers.index", component: ProducerIndex },
    { path: '/producers/create',name: "producers.create", component: ProducerCreate },
    { path: '/producers/:id',name: "producers.edit", component: ProducerEdit },

    { path: '/test/income',          name: "test.income", component: IncomeCreate },



    { path: '/agents',          name: "agents.index", component: AgentIndex },
    { path: '/agents/create',   name: "agents.create", component: AgentCreate },
    { path: '/agents/:id',      name: "agents.edit", component: AgentEdit },


    { path: '/price-types',name: "pricetypes.index", component:  PriceTypeIndex},
    { path: '/price-types/create',name: "pricetypes.create", component: PriceTypeCreate },
    { path: '/price-types/:id',name: "pricetypes.edit", component: PriceTypeEdit },


    { path: '/nomenclatures',name: "nomenclature.index", component: NomenclatureIndex },
    { path: '/nomenclatures/create',name: "nomenclature.create", component: NomenclatureCreate },
    { path: '/nomenclatures/:id',name: "nomenclature.edit", component: NomenclatureEdit },
    { path: '/nomenclatures/:id/characteristics',name: "nomenclature.characteristics", component: CharacteristicForNomenclature },

    { path: '/',name: "home.index", component: Home },





    //админские роуты

    { path: '/adm/info',name: "admin.menu.info", component: NormativeInfo },

    { path: '/adm/producers',name: "admin.producers.index", component: ProducerIndex },
    { path: '/adm/producers/create',name: "admin.producers.create", component: ProducerCreate },
    { path: '/adm/producers/:id',name: "admin.producers.edit", component: ProducerEdit },

    { path: '/adm/price-types',name: "admin.pricetypes.index", component: PriceTypeIndex },
    { path: '/adm/price-types/create',name: "admin.pricetypes.create", component: PriceTypeCreate },
    { path: '/adm/price-types/:id',name: "admin.pricetypes.edit", component: PriceTypeEdit },

    { path: '/adm/agents',name: "admin.agents.index", component: AgentIndex },
    { path: '/adm/agents/create',name: "admin.agents.create", component: PriceTypeCreate },
    { path: '/adm/agents/:id',name: "admin.agents.edit", component: PriceTypeEdit },


    { path: '/adm/nomenclatures',name: "admin.nomenclature.index", component: NomenclatureIndex },
    { path: '/adm/nomenclatures/create',name: "admin.nomenclature.create", component: NomenclatureCreate },
    { path: '/adm/nomenclatures/:id',name: "admin.nomenclature.edit", component: NomenclatureEdit },
    { path: '/adm/nomenclatures/:id/characteristics',name: "admin.nomenclature.characteristics", component: CharacteristicForNomenclature },

    { path: '/adm/home',name: "admin.home.index", component: AdminMain }


];

export default {
    routes
}

