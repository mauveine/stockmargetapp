<script setup>
import StockSearchResultTable from '@/Components/StockSearch/StockSearchResultTable.vue'
import StockSearchResultGraph from '@/Components/StockSearch/StockSearchResultGraph.vue'
import SectionBorder from '@/Components/SectionBorder.vue';

</script>
<script>
export default {}
</script>

<template>
    <div>
        <StockSearchResultTable />

        <SectionBorder />
    </div>
    <div>
        <StockSearchResultGraph />
    </div>
</template>

<style scoped>

</style>
