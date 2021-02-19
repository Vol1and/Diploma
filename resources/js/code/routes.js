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

import StorageIndex from "../components/Storage/Index";
import StorageCreate from "../components/Storage/Create";
import StorageEdit from "../components/Storage/Edit";


import NomenclatureIndex from "../components/Nomenclature/Index";
import NomenclatureCreate from "../components/Nomenclature/Create";
import NomenclatureEdit from "../components/Nomenclature/Edit";


import IncomeCreate from "../components/Documents/Income/Create";
import IncomeIndex from "../components/Documents/Income/Index";
import IncomeEdit from "../components/Documents/Income/Edit";


import SellingCreate from "../components/Documents/Selling/Create";
import SellingIndex from "../components/Documents/Selling/Index";
import SellingEdit from "../components/Documents/Selling/Edit";

import CancellationCreate from "../components/Documents/Cancellation/Create";
import CancellationIndex from "../components/Documents/Cancellation/Index";
import CancellationEdit from "../components/Documents/Cancellation/Edit";


//import CashierIndex from "../components/CashierPlace/Index"
//import MedicamentSearch from "../components/CashierPlace/MedicamentSearch"


import WaresIndex from "../components/Ware/Index"


import Home from "../components/Home";

import AdminMain from "../components/Admin/Main";

const routes = [
    {path: '/info', name: "menu.info", component: NormativeInfo},
    {path: '/wares', name: "wares.index", component: WaresIndex},

    {path: '/producers', name: "producers.index", component: ProducerIndex},
    {path: '/producers/create', name: "producers.create", component: ProducerCreate},
    {path: '/producers/:id', name: "producers.edit", component: ProducerEdit},

    {path: '/producers', name: "characteristics.index", component: ProducerIndex},
    {path: '/characteristics/create/:nomenclature_id', name: "characteristics.create", component: ProducerCreate},
    {path: '/producers/:id', name: "producers.edit", component: ProducerEdit},

    {path: '/income-documents', name: "income.index", component: IncomeIndex},
    {path: '/income-documents/create', name: "income.create", component: IncomeCreate},
    {path: '/income-documents/:id', name: "income.edit", component: IncomeEdit},


    {path: '/selling-documents', name: "selling.index", component: SellingIndex},
    {path: '/selling-documents/create', name: "selling.create", component: SellingCreate},
    {path: '/selling-documents/:id', name: "selling.edit", component: SellingEdit},

    {path: '/cancellation-documents', name: "cancellation.index", component: CancellationIndex},
    {path: '/cancellation-documents/create', name: "cancellation.create", component: CancellationCreate},
    {path: '/cancellation-documents/:id', name: "cancellation.edit", component: CancellationEdit},



    {path: '/agents', name: "agents.index", component: AgentIndex},
    {path: '/agents/create', name: "agents.create", component: AgentCreate},
    {path: '/agents/:id', name: "agents.edit", component: AgentEdit},

    {path: '/storages', name: "storages.index", component: StorageIndex},
    {path: '/storages/create', name: "storages.create", component: StorageCreate},
    {path: '/storages/:id', name: "storages.edit", component: StorageEdit},

    {path: '/price-types', name: "pricetypes.index", component: PriceTypeIndex},
    {path: '/price-types/create', name: "pricetypes.create", component: PriceTypeCreate},
    {path: '/price-types/:id', name: "pricetypes.edit", component: PriceTypeEdit},


    {path: '/nomenclatures', name: "nomenclature.index", component: NomenclatureIndex},
    {path: '/nomenclatures/create', name: "nomenclature.create", component: NomenclatureCreate},
    {path: '/nomenclatures/:id', name: "nomenclature.edit", component: NomenclatureEdit},


   //{path: '/cashier', name: "cashier.index", component: CashierIndex},
   //{path: '/test', name: "cashier.test", component: MedicamentSearch},



    {path: '/', name: "home.index", component: Home},


    //админские роуты

    {path: '/adm/info', name: "admin.menu.info", component: NormativeInfo},

    {path: '/adm/producers', name: "admin.producers.index", component: ProducerIndex},
    {path: '/adm/producers/create', name: "admin.producers.create", component: ProducerCreate},
    {path: '/adm/producers/:id', name: "admin.producers.edit", component: ProducerEdit},

    {path: '/adm/price-types', name: "admin.pricetypes.index", component: PriceTypeIndex},
    {path: '/adm/price-types/create', name: "admin.pricetypes.create", component: PriceTypeCreate},
    {path: '/adm/price-types/:id', name: "admin.pricetypes.edit", component: PriceTypeEdit},

    {path: '/adm/agents', name: "admin.agents.index", component: AgentIndex},
    {path: '/adm/agents/create', name: "admin.agents.create", component: PriceTypeCreate},
    {path: '/adm/agents/:id', name: "admin.agents.edit", component: PriceTypeEdit},


    {path: '/adm/nomenclatures', name: "admin.nomenclature.index", component: NomenclatureIndex},
    {path: '/adm/nomenclatures/create', name: "admin.nomenclature.create", component: NomenclatureCreate},
    {path: '/adm/nomenclatures/:id', name: "admin.nomenclature.edit", component: NomenclatureEdit},

    {path: '/adm/home', name: "admin.home.index", component: AdminMain}


];

export default {
    routes
}

