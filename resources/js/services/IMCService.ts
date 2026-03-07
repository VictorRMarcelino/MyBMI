import { IMC } from '@/types/imc';
import { router } from '@inertiajs/vue3';
import MessageService from './MessageService';
import { Message } from '@/types/message';

const IMCService = {
    store: function(IMC: IMC) {
        router.post('/imc/store', IMC, {
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

export default IMCService;