<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { BMI } from '@/types/bmi';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { computed, ref } from 'vue';
import BMIService from '@/services/BMIService';
import { Message } from '@/types/message';
import { Line } from 'vue-chartjs';
import type { ChartData } from 'chart.js';
import { 
  Chart as ChartJS, 
  Title, 
  Tooltip, 
  Legend, 
  LineElement,
  PointElement,
  CategoryScale, 
  LinearScale 
} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale);

const props = defineProps<{
    historyRegister: BMI[];
    message: Message;
}>();

const chartData = computed<ChartData<'line'>>(() => {
    const historyRegister = [...props.historyRegister].reverse();

    return {
        labels: historyRegister.map(reg => 
            reg.created_at ? new Date(reg.created_at) : ''
        ),
        datasets: [
            {
                label: 'BMI Evolution',
                borderColor: '#10b981',
                backgroundColor: '#10b981',  
                data: historyRegister.map(reg => reg.result ?? 0),
                tension: 0.3,                
                pointRadius: 5,              
                pointHoverRadius: 8,         
                fill: false                  
            }
        ]
    };
});

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'BMI'
            }
        }
    }
};

const height = ref(0);
const weight = ref(0);

const store = function() {
    let BMI: BMI = {
        height: height.value,
        weight: weight.value
    } 
    BMIService.store(BMI);
}

</script>
<template>
    <AppLayout>
        <div class="BMI">
            <div class="BMICalc">
                <div class="BMICalcComponets">
                    <div class="BMICalcComponetsItem">
                        <Label for="height">Height</Label>
                        <Input
                            id="height"
                            name="height"
                            type="number"
                            min="0.1"
                            step="0.01"
                            v-model="height"
                        />
                    </div>
                    <div class="BMICalcComponetsItem">
                        <Label for="weight">Weight</Label>
                        <Input
                            id="weight"
                            name="weight"
                            type="number"
                            min="0.1"
                            step="0.01"
                            v-model="weight"
                        />
                    </div>
                    <div>
                        <Button
                            type="submit"
                            @click="store"
                        >Calculate</Button>
                    </div>
                </div>
            </div>
            <div class="BMIStats">
                <div class="BMIHistory">
                    <div class="BMIHistoryTitle">
                        <Span>History</Span>
                    </div>
                    <div class="BMIHistoryContent">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date/Time</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Result</th>
                                    <th>Classification</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="historyRegister in props.historyRegister" :key="historyRegister.id">
                                    <td>{{ historyRegister.created_at }}</td>
                                    <td>{{ historyRegister.height }}</td>
                                    <td>{{ historyRegister.weight }}</td>
                                    <td>{{ historyRegister.result }}</td>
                                    <td>{{ historyRegister.classification }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="BMIGraph">
                    <div class="BMIGraphTitle">
                        <span>Graph</span>
                    </div>
                    <div class="BMIGraphChart">
                        <Line 
                            v-if="props.historyRegister.length > 0"
                            :data="chartData" 
                            :options="chartOptions" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>

    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    appearance: textfield;
    }

    * {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .BMI {
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        width: 100%;
        height: 100%;
        padding: 1rem;
        gap: 1rem;
    }

    .BMICalc {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        border: 1px solid gray;
        height: 50%;
        border-radius: 10px;
    }

    .BMICalcComponets {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 1rem;
    }

    .BMICalcComponetsItem {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
    }

    .BMIStats {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        column-gap: 1rem;
        width: 100%;
        height: 100%;
    }

    .BMIHistory {
        width: 100%;
        border: 1px solid grey;
        border-radius: 10px;
    }

    .BMIHistoryTitle, .BMIGraphTitle {
        text-align: center;
    }

    .BMIHistoryContent, .BMIHistoryContent table {
        width: 100%;
        padding: 1rem;
    }

    .BMIHistoryContent table {
        border-spacing: 1rem;
        border-collapse: collapse
    }

    .BMIHistoryContent table th,
    .BMIHistoryContent table td {
        text-align: center;
        border: 1px solid black;
        padding: 0.3rem;
    }

    .BMIGraph {
        width: 100%;
        border: 1px solid grey;
        border-radius: 10px;
    }

    .BMIGraphChart {
        height: 90%;
    }

</style>