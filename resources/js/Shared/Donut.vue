<template>
    <div class="chart">
        <DoughnutChart :chartData="testData" />
    </div>

</template>

<script lang="ts">
import {computed, defineComponent, ref} from 'vue';
import { DoughnutChart } from 'vue-chart-3';
import { Chart, registerables } from "chart.js";


Chart.register(...registerables);

export default defineComponent({

    name: 'Home',
    components: { DoughnutChart },
    props: {
        labels: Array,
        data: Array
    },
    setup(props) {

        const testData = computed(() => ({
            labels: props.labels,
            datasets: [
                {
                    data: props.data,
                    backgroundColor: ['#008000', '#DAA520', '#000000', '#DC143C', '#D3D3D3'],
                },
            ],
        }));

        return { testData };
    }
});
</script>

<style>
.chart {
    width: 100%;
    height: auto;
}
</style>
