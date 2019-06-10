<template>
    <div :class="notificationClasses"
         class="notification-alert-box">
        <div class="notification">
            <header class="">{{ title }}</header>
            <p class="main-message">{{ message }}</p>
            <p v-if="status === 'error'" class="error-refresh">We suggest you refresh the page and try again.</p>
        </div>
        <div class="notification-actions">
            <button @click="show = false">Dismiss</button>
        </div>
    </div>
</template>

<script type="text/babel">
    import {EventBus} from "./EventBus";

    export default {
        data() {
            return {
                show: false,
                status: 'error',
                title: '',
                message: '',
                timeout: null
            };
        },

        computed: {
            notificationClasses() {
                return {
                    'in-active': !this.show,
                    'error': this.status === 'error',
                    'success': this.status === 'success',
                };
            }
        },

        mounted() {
            EventBus.$on('notify:error', this.handleErrorNotification);
            EventBus.$on('notify:success', this.handleSuccessNotification);

            window.addEventListener('keyup', ({key}) => {
                if (key === 'Escape') {
                    this.show = false;
                }
            });

            window.addEventListener('load', this.checkFlashMessages);


        },
        methods: {


            handleErrorNotification({title = 'Error!', message, clear}) {
                this.status = 'error';
                this.title = title;
                this.message = message;
                this.showNotification(clear);
            },

            handleSuccessNotification({title = 'Success!', message, clear}) {
                this.status = 'success';
                this.title = title;
                this.message = message;
                this.showNotification(clear);
            },

            showNotification(clear) {
                this.show = true;

                if(clear) {
                    if(this.timeout) {
                        window.clearTimeout(this.timeout);
                    }

                    this.timeout = window.setTimeout(() => this.show = false, 2000);
                }
            },

            checkFlashMessages() {
                if(window.flashMessage) {
                    this.handleNotification(window.flashMessage);
                }
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/css">
    .notification-alert-box {
        position: fixed;
        max-width: 25rem;
        width: 100%;
        margin: 0 auto;
        border-radius: 5px;
        background-color: #fff;
        border: 1px solid;

        bottom: 80px;
        left: 50%;
        transform-origin: center center;
        transform: scale(1) translate3d(-50%, 0, 0);
        opacity: 1;
        transition: .2s ease-in-out;
        visibility: visible;
    }

    .notification-alert-box header {
        color: #fff;
        text-align: center;
        padding: 1rem;
        font-weight: 700;
    }

    .notification-alert-box.in-active {
        opacity: 0;
        transform: scale(.8) translate3d(-50%, 40px, 0);
        visibility: hidden;
        pointer-events: none;
    }

    .notification-alert-box.error {
        border-color: #FF4943;
    }

    .notification-alert-box.success {
        border-color: #178041;
    }

    .notification-alert-box.error header {
        background-color: #FF4943;
    }

    .notification-alert-box.success header {
        background-color: #178041;
    }

    .notification .main-message {
        text-align: center;
        padding: 1rem;
        padding-top: 2rem;
    }

    .notification-actions {
        display: flex;
        justify-content: flex-end;
        padding-bottom: 1rem;
        padding-right: 1rem;
    }

    .notification-actions button {
        font-weight: 700;
        background: none;
        border: none;
        text-decoration: underline;
        color: grey;
    }

    .error-refresh {
        font-size: 90%;
        padding: 0 1rem;
        text-align: center;

    }



</style>