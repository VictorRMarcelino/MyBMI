import { BMI } from '@/types/bmi';
import { router } from '@inertiajs/vue3';
import MessageService from './MessageService';
import { Message } from '@/types/message';

const BMIService = {
    store: function(BMI: BMI) {
        router.post('/imc/store', BMI, {
            onSuccess: (result) => {
                let messageOptions: Message = {
                    text: ""
                }
                MessageService.info(messageOptions);
                router.visit('/imc/', {
                    method: 'get'
                })
            },
            onError: (errors) => {
                let messageOptions: Message = {
                    text: "deu erro pai"
                }
                MessageService.error(messageOptions);
            }
        });
    }
}

export default BMIService;