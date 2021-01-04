<template>
<div class="center-50">
    <ul class="list-group">
        <li class="list-group-item">
            <router-link  class="nav-link" :to="{name: 'producers.index'}">Производители</router-link>

        </li>
        <li class="list-group-item">

            <router-link  class="nav-link" :to="{name: 'pricetypes.index'}">Типы цен</router-link>
        </li>
        <li class="list-group-item">

            <router-link  class="nav-link" :to="{name: 'nomenclature.index'}">Номенклатура</router-link>
        </li>
        <li class="list-group-item">

            <router-link  class="nav-link" :to="{name: 'agents.index'}">Контрагенты</router-link>
        </li>
    </ul>
</div>
</template>

<script>
export default {
    name: "NormativeInfo"
}
</script>
