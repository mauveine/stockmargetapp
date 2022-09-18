<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import { Line } from 'vue-chartjs'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    CategoryScale,
    LinearScale,
    PointElement
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, CategoryScale, LinearScale, PointElement, LineElement)

const stockInfo = computed(() => {
    return usePage().props.value.stockInfo
})
const chartData = computed(() => {
    let labels = stockInfo.value.map((item) => {
        return item.date
    })

    return {
        labels: labels,
        datasets: [
            {
                label: 'Open',
                backgroundColor: '#009900',
                borderColor: '#009900',
                data: stockInfo.value.map((item) => item.open)
            },
            {
                label: 'Close',
                backgroundColor: '#990000',
                borderColor: '#990000',
                data: stockInfo.value.map((item) => item.close)
            }
        ]
    }
})

const chartOptions = computed(() => {
    return {
        responsive: true,
        maintainAspectRatio: false
    }
})
</script>
<script>
export default {}
</script>

<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <Line :chart-data="chartData" :chart-options="chartOptions" :height="400"/>
    </div>
</template>

<style scoped>

</style>
