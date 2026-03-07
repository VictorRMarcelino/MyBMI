import Swal, { SweetAlertIcon } from "sweetalert2"
import { Message } from "@/types/message";
import $ from "jquery";

const MessageService = {

    /** Show a new message in the system */
    show: function(settings: Message) {
        Swal.fire(settings);
    },

    /** Show a success message in the system */
    success: function(options: Message) {
        let settings: Message = $.extend({
            title: "Success!",
            icon: "success",
        }, options);
        MessageService.show(settings);
    },

    /** Show a warning message in the system */
    warn: function(options: Message) {
        let settings: Message = $.extend({
            title: "Warning!",
            icon: "warning",
        }, options);
        MessageService.show(settings);
    },

    /** Show a error message in the system */
    error: function(options: Message) {
        let settings: Message = $.extend({
            title: "Error!",
            icon: "error",
        }, options);
        MessageService.show(settings);
    },

    /** Show a information message in the system */
    info: function(options: Message) {
        let settings: Message = $.extend({
            title: "Information!",
            icon: "info",
        }, options);
        MessageService.show(settings);
    },
}

export default MessageService;