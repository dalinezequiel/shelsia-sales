<script setup>
import { ref, reactive } from 'vue';
import { LineChart } from 'vue-chart-3';
import { Chart, registerables } from 'chart.js';

const props = defineProps({
    forecasts: {
        type: Object,
        required: false
    },
    sales: {
        type: Object,
        required: false
    }
})

const labels = [];
const forecast = props.forecasts?.map(item => {
    const date = new Date(item.ds);
    labels.push(date.toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric'
    }));
    return {
        x: date.getDate(),
        y: item.yhat
    };
});

const history = props.sales?.map(item => {
    const date = new Date(item.ds);
    return {
        x: date.getDate(),
        y: item.y
    };
});

const applyColor = (ctx, forecast_color, future_color) => ctx.p0.parsed.x >= history.length ? future_color : forecast_color;
const pointBackgroundColor = (ctx, forecast_color, future_color) => ctx.dataIndex >= history.length ? future_color : forecast_color;

Chart.register(...registerables);
const chartData = reactive({
    labels: labels,
    datasets: [
        {
            label: 'Previsto',
            data: forecast,
            backgroundColor: ctx => pointBackgroundColor(ctx, '#CD8232', '#36AD5E'),
            pointStyle: 'circle',
            pointRadius: 6,
            segment: {
                borderColor: ctx => applyColor(ctx, '#CD8232', '#36AD5E')
            }
        },
        {
            label: 'Histórico',
            backgroundColor: '#696969',
            borderColor: '#696969',
            data: history,
            pointStyle: 'circle',
            pointRadius: 6
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
            text: 'Vendas',
        }
    },
    scales: {
        x: {
            display: true,
            title: {
                display: true,
                text: 'Dias, Ano '.concat(new Date().getFullYear())
            }
        },
        y: {
            display: true,
            title: {
                display: true,
                text: 'Faturamento'
            }
        }
    }
});
</script>

<template>
    <LineChart :chartData="chartData" :options="chartOptions" />
</template>