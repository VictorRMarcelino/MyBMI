import { BMI } from '@/types/bmi';
import { router } from '@inertiajs/vue3';
import MessageService from './MessageService';
import { Message } from '@/types/message';

const BMIService = {
    store: function(BMI: BMI) {
        debugger
        router.post('/bmi/store', BMI, {
            onSuccess: (result) => {
                let messageOptions: Message = {
                    text: ""
                }
                MessageService.info(messageOptions);
                router.visit('/bmi/', {
                    method: 'get'
                })
            },
            onError: (errors) => {
                debugger
                let messageOptions: Message = {
                    text: "deu erro pai"
                }
                MessageService.error(messageOptions);
            }
        });
    }
}

export default BMIService;