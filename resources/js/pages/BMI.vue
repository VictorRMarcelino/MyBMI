<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { BMI } from '@/types/bmi';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';
import BMIService from '@/services/BMIService';

const props = defineProps<{
    historyRegister: BMI[];
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
                    <Input
                        id="height"
                        name="height"
                        type="numeric"
                        v-model="height"
                    />
                    <Input
                        id="weight"
                        name="weight"
                        type="numeric"
                        v-model="weight"
                    />
                    <Button
                        type="submit"
                        v-on:click="store()"
                    >Calcular</Button>
                </div>
            </div>
            <div class="BMIStats">
                <div class="BMIHistory">
                    <div class="BMIHistoryTitle">
                        <Span>History</Span>
                    </div>
                    <table>
                        <thead></thead>
                        <tbody v-for="historyRegister in props.historyRegister" :key="historyRegister.id">
                            <tr>
                                <td>
                                    <span>teste</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        border: 1px solid red;
        padding: 1rem;
        gap: 1rem;
    }

    .BMICalc {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        border: 1px solid blue;
        height: 50%;
    }

    .BMICalcComponets {
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 1rem;
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
        border: 1px solid green;
    }

    .BMIHistoryTitle, .BMIGraphTitle {
        text-align: center;
    }

    .BMIGraph {
        width: 100%;
        border: 1px solid yellow;
    }

</style>