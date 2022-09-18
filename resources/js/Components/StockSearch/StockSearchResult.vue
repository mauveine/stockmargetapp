<script setup>
import StockSearchResultTable from '@/Components/StockSearch/StockSearchResultTable.vue'
import StockSearchResultGraph from '@/Components/StockSearch/StockSearchResultGraph.vue'
import SectionBorder from '@/Components/SectionBorder.vue';
import { ref, defineProps, computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const stockInfo = computed(() => {
    return usePage().props.value.stockInfo
})

</script>
<script>
export default {}
</script>

<template>
    <div v-if="stockInfo">
        <StockSearchResultTable />

        <SectionBorder />
    </div>
    <div v-if="stockInfo">
        <StockSearchResultGraph />
    </div>
</template>

<style scoped>

</style>
