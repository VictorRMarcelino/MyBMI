<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { IMC } from '@/types/imc';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';
import IMCService from '@/services/IMCService';
import { Head } from '@inertiajs/vue3';

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
    <Head title="teste" />
    <AppLayout>
        <div class="IMC">
            <div class="IMCCalc">
                <div>
                    <Input
                        id="height"
                        name="height"
                        type="numeric"
                        required
                        placeholder="Height..."
                        v-model="height"
                    />
                    <Input
                        id="weight"
                        name="weight"
                        type="numeric"
                        required
                        placeholder="Weight..."
                        v-model="weight"
                    />
                    <Button
                        type="submit"
                        class="mt-2 w-full"
                        v-on:click="store()"
                    ></Button>
                </div>
            </div>
            <div>
                <div class="IMCHistory">
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
<style scoped></style>