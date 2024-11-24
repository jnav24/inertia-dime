<script setup lang="ts">
import Chart, { ChartConfiguration, ChartDatasetCustomTypesPerDataset } from 'chart.js/auto';
import { onMounted, ref, watch } from 'vue';

type Props = {
    labels: string[];
    data: ChartDatasetCustomTypesPerDataset[];
};

let chart: Chart;

const props = defineProps<Props>();

const data: ChartConfiguration = {
    type: 'line',
    data: {
        labels: ['A', 'B', 'C'],
        datasets: [
            {
                label: 'Dataset 1',
                data: [1, 2, 3],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
            {
                label: 'Dataset 2',
                data: [2, 3, 4],
                borderColor: '#FF6384',
                backgroundColor: '#FFB1C1',
            },
        ],
    },
    options: {},
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
