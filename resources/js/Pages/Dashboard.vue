<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StockSearch from '@/Components/StockSearch.vue'
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <StockSearch />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="css">
#nprogress .bar {
    height: 5px !important;
}
</style>
