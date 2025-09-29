<script setup lang="ts">
import Chart, { ChartConfiguration, ChartDatasetCustomTypesPerDataset } from 'chart.js/auto';
import { onMounted, ref, watch } from 'vue';

type Props = {
    labels: string[];
    data: ChartDatasetCustomTypesPerDataset[];
    hideLegend?: boolean;
};

let chart: Chart;

const props = defineProps<Props>();

const data: ChartConfiguration = {
    type: 'doughnut',
    data: {
        labels: props.labels,
        datasets: props.data,
    },
    options: {
        plugins: {
            legend: {
                display: !props.hideLegend,
            },
        },
    },
};
const myChart = ref<HTMLCanvasElement | null>(null);

onMounted(() => {
    chart = new Chart(myChart.value as HTMLCanvasElement, data);
});

watch(
    () => props.data,
    () => {
        data.data.datasets = props.data;
        data.data.labels = props.labels;
        chart.update();
    },
);
</script>

<template>
    <canvas ref="myChart"></canvas>
</template>
