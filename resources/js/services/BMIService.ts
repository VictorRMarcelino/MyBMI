import { BMI } from '@/types/bmi';
import { router } from '@inertiajs/vue3';
import MessageService from './MessageService';
import { Message } from '@/types/message';

const BMIService = {
    store: function(BMI: BMI) {
        debugger
        router.post('/bmi/store', BMI, {
            onSuccess: (result) => {
                debugger
                let messageOptions: Message = {
                    text: ''
                }
                MessageService.info(messageOptions);
                // router.visit('/bmi/', {
                //     method: 'get'
                // })
            },
            onError: (errors) => {
                let messageOptions: Message = {
                    text: Object.values(errors)[0]
                }
                MessageService.error(messageOptions);
            }
        });
    }
}

export default BMIService;