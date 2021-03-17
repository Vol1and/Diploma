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

import WorkPlaceCreate from "../components/WorkPlace/Create";
import WorkPlaceIndex from "../components/WorkPlace/Index";
import WorkPlaceEdit from "../components/WorkPlace/Edit";

import CancellationCreate from "../components/Documents/Cancellation/Create";
import CancellationIndex from "../components/Documents/Cancellation/Index";
import CancellationEdit from "../components/Documents/Cancellation/Edit";


import TransferCreate from "../components/Documents/Transfer/Create";
import TransferIndex from "../components/Documents/Transfer/Index";
import TransferEdit from "../components/Documents/Transfer/Edit";


import CashierIndex from "../components/CashierPlace/Index"
import WaresIndex from "../components/Ware/Index"

import TotalSalesContainer from "../components/Charts/TotalSalesContainer";
import UsersSalesContainer from "../components/Charts/UsersSalesContainer"
import StoragesSalesContainer from "../components/Charts/StoragesSalesContainer";
import AgentsCashContainer from "../components/Charts/AgentsCashContainer";
import Home from "../components/Menu/Home";
import Login from "../components/Auth/Login"

import DashBoard from "../components/Menu/DashBoard"

const routes = [
    {path: '/wares', name: "wares.index", component: WaresIndex, meta: {requiresAuth: true, access_rate: 1}},

    {path: '/producers', name: "producers.index", component: ProducerIndex, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/producers/create', name: "producers.create", component: ProducerCreate, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/producers/:id', name: "producers.edit", component: ProducerEdit, meta: {requiresAuth: true, access_rate: 2}},

    {path: '/income-documents', name: "income.index", component: IncomeIndex, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/income-documents/create', name: "income.create", component: IncomeCreate, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/income-documents/:id', name: "income.edit", component: IncomeEdit, meta: {requiresAuth: true, access_rate: 2}},

    {path: '/selling-documents', name: "selling.index", component: SellingIndex, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/selling-documents/create', name: "selling.create", component: SellingCreate, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/selling-documents/:id', name: "selling.edit", component: SellingEdit, meta: {requiresAuth: true, access_rate: 2}},

    {
        path: '/cancellation-documents',
        name: "cancellations.index",
        component: CancellationIndex,
        meta: {requiresAuth: true, access_rate: 2}
    },
    {
        path: '/cancellation-documents/create',
        name: "cancellations.create",
        component: CancellationCreate,
        meta: {requiresAuth: true, access_rate: 2}
    },
    {
        path: '/cancellation-documents/:id',
        name: "cancellations.edit",
        component: CancellationEdit,
        meta: {requiresAuth: true, access_rate: 2}
    },

    {path: '/transfer-documents', name: "transfers.index", component: TransferIndex, meta: {requiresAuth: true, access_rate: 2}},
    {
        path: '/transfer-documents/create',
        name: "transfers.create",
        component: TransferCreate,
        meta: {requiresAuth: true, access_rate: 2}
    },
    {path: '/transfer-documents/:id', name: "transfers.edit", component: TransferEdit, meta: {requiresAuth: true, access_rate: 2}},

    {path: '/agents', name: "agents.index", component: AgentIndex, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/agents/create', name: "agents.create", component: AgentCreate, meta: {requiresAuth: true, access_rate: 2}},
    {path: '/agents/:id', name: "agents.edit", component: AgentEdit, meta: {requiresAuth: true, access_rate: 2}},

    {path: '/workplaces', name: "workplaces.index", component: WorkPlaceIndex, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/workplaces/create', name: "workplaces.create", component: WorkPlaceCreate, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/workplaces/:id', name: "workplaces.edit", component: WorkPlaceEdit, meta: {requiresAuth: true, access_rate: 3}},

    {path: '/storages', name: "storages.index", component: StorageIndex, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/storages/create', name: "storages.create", component: StorageCreate, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/storages/:id', name: "storages.edit", component: StorageEdit, meta: {requiresAuth: true, access_rate: 3}},

    {path: '/price-types', name: "pricetypes.index", component: PriceTypeIndex, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/price-types/create', name: "pricetypes.create", component: PriceTypeCreate, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/price-types/:id', name: "pricetypes.edit", component: PriceTypeEdit, meta: {requiresAuth: true, access_rate: 3}},

    {path: '/nomenclatures', name: "nomenclature.index", component: NomenclatureIndex, meta: {requiresAuth: true, access_rate: 2}},
    {
        path: '/nomenclatures/create',
        name: "nomenclature.create",
        component: NomenclatureCreate,
        meta: {requiresAuth: true, access_rate: 2}
    },
    {path: '/nomenclatures/:id', name: "nomenclature.edit", component: NomenclatureEdit, meta: {requiresAuth: true, access_rate: 2}},

    {path: '/cashier', name: "cashier.index", component: CashierIndex, meta: {requiresAuth: true, access_rate: 1}},
//    {path: '/test', name: "cashier.test", component: MedicamentSearch, meta: {requiresAuth: true, access_rate: 0}},

    {path: '/', name: "home.index", component: Home, meta: {requiresAuth: true, access_rate: 1}},
    {path: '/login', name: 'login', component: Login, meta: {requiresAuth: false}},

    {path: '/charts/total-sales', name: "charts.total", component: TotalSalesContainer, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/charts/users-cash', name: "charts.users", component: UsersSalesContainer, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/charts/storages-sales', name: "charts.storages", component: StoragesSalesContainer, meta: {requiresAuth: true, access_rate: 3}},
    {path: '/charts/agents-cash', name: "charts.agents", component: AgentsCashContainer, meta: {requiresAuth: true, access_rate: 3}},


    {path: '/dashboard', name: 'dashboard', component: DashBoard, meta: {requiresAuth: true, access_rate: 3}},

  ];

export default {
    routes
}

