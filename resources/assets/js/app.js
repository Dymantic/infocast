
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.config.ignoredElements = [
    'trix-editor',
];
import Datepicker from "vuejs-datepicker";
import swal from "sweetalert";
window.swal = swal;

import Dropdown from './components/Dropdown.vue';
import Modal from './components/Modal.vue';
import DeleteModal from './components/DeleteModal.vue';
import ResetPassword from './components/ResetPasswordForm.vue';
import RequestPassword from './components/RequestPasswordReset.vue';
import UserForm from './components/UserForm.vue';
import UserList from './components/UserList.vue';
import UserItem from './components/User.vue';
import ToggleSwitch from './components/Toggle.vue';
import ImageUpload from './components/Singleupload.vue';
import PostingForm from './components/PostingForm.vue';
import ApplicationFields from './components/PostingApplicationFieldsSetter.vue';
import SortableList from './components/SortableList.vue';
import CaseStudiesIndex from './components/CaseStudies/Index.vue';
import CaseStudyEditor from './components/CaseStudies/Edit.vue';
import NotificationHub from './components/Notifications/NotificationHub.vue';
import CandidateTrackingPage from './components/Candidates/CandidateTrackingPage';


Vue.component('date-picker', Datepicker);
Vue.component('dropdown', Dropdown);
Vue.component('modal', Modal);
Vue.component('delete-modal', DeleteModal);
Vue.component('reset-password', ResetPassword);
Vue.component('request-password', RequestPassword);
Vue.component('user-form', UserForm);
Vue.component('user-list', UserList);
Vue.component('user-item', UserItem);
Vue.component('toggle-switch', ToggleSwitch);
Vue.component('image-upload', ImageUpload);
Vue.component('posting-form', PostingForm);
Vue.component('application-fields', ApplicationFields);
Vue.component('sortable-list', SortableList);
Vue.component('case-studies-index', CaseStudiesIndex);
Vue.component('case-study-editor', CaseStudyEditor);
Vue.component('notification-hub', NotificationHub);
Vue.component('candidate-tracking-page', CandidateTrackingPage);


window.eventHub = new Vue();

const app = new Vue({
    el: '#app',

    created() {
        eventHub.$on('user-alert', this.showAlert);
    },

    methods: {
        showAlert(message) {
            swal({
                icon: message.type,
                title: message.title,
                text: message.text,
                button: message.confirm
            });
        }
    }
});
