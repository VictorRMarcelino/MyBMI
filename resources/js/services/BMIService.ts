import { BMI } from '@/types/bmi';
import { router, usePage } from '@inertiajs/vue3';
import MessageService from './MessageService';
import { Message } from '@/types/message';

const BMIService = {
    store: function(BMI: BMI) {
        router.post('/bmi/store', BMI, {
            onSuccess: () => {
                debugger
                const page = usePage();
                const props = page.props as any;
                const message = props.flash?.message;

                if (message) {
                    let messageOptions: Message = {
                        text: message.text
                    };
                    MessageService.success(messageOptions);
                }
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