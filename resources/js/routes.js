
import NormativeInfo from "./components/Menu/NormativeInfo";
import ProducerIndex from "./components/Producer/Index";
import ProducerCreate from "./components/Producer/Create";
import ProducerEdit from "./components/Producer/Edit";
import PriceTypeIndex from "./components/PriceType/Index";
import PriceTypeCreate from "./components/PriceType/Create";
import PriceTypeEdit from "./components/PriceType/Edit";
import NomenclatureIndex from "./components/Nomenclature/Index";
import NomenclatureCreate from "./components/Nomenclature/Create";
import NomenclatureEdit from "./components/Nomenclature/Edit";
import CharacteristicForNomenclature from "./components/Characteristic/ForNomenclature";
import Home from "./components/Home";

import AdminMain from "./components/Admin/Main";

const routes = [
    { path: '/info',name: "menu.info", component: NormativeInfo },


    { path: '/producers',name: "producers.index", component: ProducerIndex },
    { path: '/producers/create',name: "producers.create", component: ProducerCreate },
    { path: '/producers/:id',name: "producers.edit", component: ProducerEdit },


    { path: '/price-types',name: "price-types.index", component: PriceTypeIndex },
    { path: '/price-types/create',name: "price-types.create", component: PriceTypeCreate },
    { path: '/price-types/:id',name: "price-types.edit", component: PriceTypeEdit },


    { path: '/nomenclatures',name: "nomenclatures.index", component: NomenclatureIndex },
    { path: '/nomenclatures/create',name: "nomenclatures.create", component: NomenclatureCreate },
    { path: '/nomenclatures/:id',name: "nomenclatures.edit", component: NomenclatureEdit },
    { path: '/nomenclatures/:id/characteristics',name: "nomenclatures.characteristics", component: CharacteristicForNomenclature },

    { path: '/',name: "home.index", component: Home },





    //админские роуты

    { path: '/adm/info',name: "admin.menu.info", component: NormativeInfo },

    { path: '/adm/producers',name: "admin.producers.index", component: ProducerIndex },
    { path: '/adm/producers/create',name: "admin.producers.create", component: ProducerCreate },
    { path: '/adm/producers/:id',name: "admin.producers.edit", component: ProducerEdit },

    { path: '/adm/price-types',name: "admin.price-types.index", component: PriceTypeIndex },
    { path: '/adm/price-types/create',name: "admin.price-types.create", component: PriceTypeCreate },
    { path: '/adm/price-types/:id',name: "admin.price-types.edit", component: PriceTypeEdit },

    { path: '/adm/nomenclatures',name: "admin.nomenclatures.index", component: NomenclatureIndex },
    { path: '/adm/nomenclatures/create',name: "admin.nomenclatures.create", component: NomenclatureCreate },
    { path: '/adm/nomenclatures/:id',name: "admin.nomenclatures.edit", component: NomenclatureEdit },
    { path: '/adm/nomenclatures/:id/characteristics',name: "admin.nomenclatures.characteristics", component: CharacteristicForNomenclature },

    { path: '/adm/home',name: "admin.home.index", component: AdminMain }


];

export default {
    routes
}

