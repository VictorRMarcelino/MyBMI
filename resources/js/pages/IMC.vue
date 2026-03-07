<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { IMC } from '@/types/imc';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';
import IMCService from '@/services/IMCService';

const props = defineProps<{
    historyRegister: IMC[];
}>();

const height = ref(0);
const weight = ref(0);
const store = function() {
    let IMC: IMC = {
        height: height.value,
        weight: weight.value
    } 
    IMCService.store(IMC);
}

</script>
<template>
    <AppLayout>
        <div class="IMC">
            <div class="IMCCalc">
                <div class="IMCCalcComponets">
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
            <div class="IMCStats">
                <div class="IMCHistory">
                    <div class="IMCHistoryTitle">
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
                <div class="IMCGraph"></div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>

    .IMC {
        margin: 5%;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        width: 100%;
        height: 100%;
        border: 1px solid red;
        padding: 1rem;
        gap: 1rem;
    }

    .IMCCalc {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        border: 1px solid blue;
        height: 100%;
    }

    .IMCCalcComponets {
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 1rem;
    }

    .IMCStats {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        column-gap: 1rem;
        width: 100%;
        height: 100%;
    }

    .IMCHistory {
        width: 100%;
        border: 1px solid green;
    }

    .IMCHistoryTitle {
        text-align: center;
    }

    .IMCGraph {
        width: 100%;
        border: 1px solid yellow;
    }

</style>