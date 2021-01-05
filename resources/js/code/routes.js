
import NormativeInfo from "../components/Menu/NormativeInfo";
import ProducerIndex from "../components/Producer/Index";
import ProducerCreate from "../components/Producer/Create";
import ProducerEdit from "../components/Producer/Edit";

import AgentIndex from "../components/Agents/Index";
import AgentCreate from "../components/Agents/Create";
import AgentEdit from "../components/Agents/Edit";

import PriceTypeIndex from "../components/PriceType/Index";
import PriceTypeCreate from "../components/PriceType/Create";
import PriceTypeEdit from "../components/PriceType/Edit";

import NomenclatureIndex from "../components/Nomenclature/Index";
import NomenclatureCreate from "../components/Nomenclature/Create";
import NomenclatureEdit from "../components/Nomenclature/Edit";

import CharacteristicForNomenclature from "../components/Characteristic/ForNomenclature";


import Home from "../components/Home";

import AdminMain from "../components/Admin/Main";

const routes = [
    { path: '/info',name: "menu.info", component: NormativeInfo, props : true },


    { path: '/producers',name: "producers.index", component: ProducerIndex, props : true },
    { path: '/producers/create',name: "producers.create", component: ProducerCreate, props : true },
    { path: '/producers/:id',name: "producers.edit", component: ProducerEdit, props : true },


    { path: '/agents',          name: "agents.index", component: AgentIndex, props : true },
    { path: '/agents/create',   name: "agents.create", component: AgentCreate, props : true },
    { path: '/agents/:id',      name: "agents.edit", component: AgentEdit, props : true },


    { path: '/price-types',name: "pricetypes.index", component:  PriceTypeIndex, props : true},
    { path: '/price-types/create',name: "pricetypes.create", component: PriceTypeCreate, props : true },
    { path: '/price-types/:id',name: "pricetypes.edit", component: PriceTypeEdit, props : true },


    { path: '/nomenclatures',name: "nomenclature.index", component: NomenclatureIndex, props : true },
    { path: '/nomenclatures/create',name: "nomenclature.create", component: NomenclatureCreate, props : true },
    { path: '/nomenclatures/:id',name: "nomenclature.edit", component: NomenclatureEdit, props : true },
    { path: '/nomenclatures/:id/characteristics',name: "nomenclature.characteristics", component: CharacteristicForNomenclature, props : true },

    { path: '/',name: "home.index", component: Home, props : true },





    //админские роуты

    { path: '/adm/info',name: "admin.menu.info", component: NormativeInfo, props : true },

    { path: '/adm/producers',name: "admin.producers.index", component: ProducerIndex, props : true },
    { path: '/adm/producers/create',name: "admin.producers.create", component: ProducerCreate, props : true },
    { path: '/adm/producers/:id',name: "admin.producers.edit", component: ProducerEdit, props : true },

    { path: '/adm/price-types',name: "admin.pricetypes.index", component: PriceTypeIndex, props : true },
    { path: '/adm/price-types/create',name: "admin.pricetypes.create", component: PriceTypeCreate, props : true },
    { path: '/adm/price-types/:id',name: "admin.pricetypes.edit", component: PriceTypeEdit, props : true },

    { path: '/adm/agents',name: "admin.agents.index", component: AgentIndex, props : true },
    { path: '/adm/agents/create',name: "admin.agents.create", component: PriceTypeCreate, props : true },
    { path: '/adm/agents/:id',name: "admin.agents.edit", component: PriceTypeEdit, props : true },


    { path: '/adm/nomenclatures',name: "admin.nomenclature.index", component: NomenclatureIndex, props : true },
    { path: '/adm/nomenclatures/create',name: "admin.nomenclature.create", component: NomenclatureCreate, props : true },
    { path: '/adm/nomenclatures/:id',name: "admin.nomenclature.edit", component: NomenclatureEdit, props : true },
    { path: '/adm/nomenclatures/:id/characteristics',name: "admin.nomenclature.characteristics", component: CharacteristicForNomenclature, props : true },

    { path: '/adm/home',name: "admin.home.index", component: AdminMain }


];

export default {
    routes
}

