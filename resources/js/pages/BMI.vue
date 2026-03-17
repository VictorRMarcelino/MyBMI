<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { BMI } from '@/types/bmi';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';
import BMIService from '@/services/BMIService';
import { Message } from '@/types/message';

const props = defineProps<{
    historyRegister: BMI[];
    message: Message;
}>();

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
                            v-on:click="store()"
                        >Calcular</Button>
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
                            <tbody v-for="historyRegister in props.historyRegister" :key="historyRegister.id">
                                <tr>
                                    <td>{{ historyRegister.created_at }}</td>
                                    <td>{{ historyRegister.height }}</td>
                                    <td>{{ historyRegister.weight }}</td>
                                    <td>{{ historyRegister.result }}</td>
                                    <td>{{ historyRegister.id }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="BMIGraph">
                    <div class="BMIGraphTitle">
                        <span>Graph</span>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>

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

</style>