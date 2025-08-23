<script setup>
import { ref, reactive, watch } from 'vue';
import { LineChart } from 'vue-chart-3';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);
const chartData = reactive({
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
            label: 'My First Dataset',
            backgroundColor: '#f87979',
            data: [40, 20, 12, 39, 10, 40, 39],
        },
        {
            label: 'My First Dataset',
            backgroundColor: '#f87979',
            data: [45, 10, 12, 29, 1, 30, 49],
        },
    ],
});

const chartOptions = ref({
    responsive: true,
    maintainAspectRatio: false,
    // ... other chart.js options
});
</script>

<template>
    <LineChart :chartData="chartData" :options="chartOptions" />
</template>