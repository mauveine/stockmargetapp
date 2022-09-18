<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

let stockInfo = ref(usePage().props.value.stockInfo)
</script>
<script>
export default {}
</script>

<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <table class="border-collapse table-auto w-full text-sm">
            <thead>
            <tr class="border border-gray-100">
                <th class="border border-gray-100 p-3">Date</th>
                <th class="border border-gray-100 p-3">Open</th>
                <th class="border border-gray-100 p-3">High</th>
                <th class="border border-gray-100 p-3">Low</th>
                <th class="border border-gray-100 p-3">Close</th>
                <th class="border border-gray-100 p-3">Volume</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in stockInfo">
                <td class="border border-gray-100 p-3">{{ item.date }}</td>
                <td class="border border-gray-100 p-3">{{ item.open }}</td>
                <td class="border border-gray-100 p-3">{{ item.high }}</td>
                <td class="border border-gray-100 p-3">{{ item.low }}</td>
                <td class="border border-gray-100 p-3">{{ item.close }}</td>
                <td class="border border-gray-100 p-3">{{ item.volume }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
