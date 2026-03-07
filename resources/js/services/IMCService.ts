import { IMC } from '@/types/imc';
import { router } from '@inertiajs/vue3';
import MessageService from './MessageService';
import { Message } from '@/types/message';

const IMCService = {
    store: function(IMC: IMC) {
        router.post('/imc/store', IMC, {
            onSuccess: () => {
                let messageOptions: Message = {
                    text: "teste"
                }
                MessageService.info(messageOptions)
                router.visit('/imc/', {
                    method: 'get'
                })
            }
        });
    }
}

export default IMCService;