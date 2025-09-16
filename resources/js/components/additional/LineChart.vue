<script setup>
import { ref, reactive, watch } from 'vue';
import { LineChart } from 'vue-chart-3';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);
const chartData = reactive({
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
            label: 'Histórico',
            backgroundColor: '#696969',
            borderColor: '#696969',
            data: [35, 25, 17, 30, 14],
            pointStyle: 'circle',
            pointRadius: 6,
        },
        {
            label: 'Futuro',
            backgroundColor: '#CD8232',
            borderColor: '#CD8232',
            data: [40, 20, 12, 39, 20],
            pointStyle: 'circle',
            pointRadius: 6,
        },
        {
            label: 'Previsão',
            backgroundColor: '#36AD5E',
            borderColor: '#36AD5E',
            data: [, , , , 20, 30, 49],
            pointStyle: 'circle',
            pointRadius: 6,
        },
    ],
});

const chartOptions = ref({
    type: 'line',
    responsive: true,
    maintainAspectRatio: false,
    interaction: {
        mode: 'index',
        intersect: false,
    },
    plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: (ctx) => 'Descrição',
        }
    },
    scales: {
        x: {
            display: true,
            title: {
                display: true,
                text: 'Month'
            }
        },
        y: {
            display: true,
            title: {
                display: true,
                text: 'Value'
            }
        }
    }
    // ... other chart.js options
});
</script>

<template>
    <LineChart :chartData="chartData" :options="chartOptions" />
</template>