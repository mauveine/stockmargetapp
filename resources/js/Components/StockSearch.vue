<script setup>
import StockSearchForm from '@/Components/StockSearch/StockSearchForm.vue'
import StockSearchResult from '@/Components/StockSearch/StockSearchResult.vue'
import SectionBorder from '@/Components/SectionBorder.vue';

</script>
<script>
export default {}
</script>

<template>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div>
                <StockSearchForm />

                <SectionBorder />
            </div>
            <div>
                <StockSearchResult />

                <SectionBorder />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
