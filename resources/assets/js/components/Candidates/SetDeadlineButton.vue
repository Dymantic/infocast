<template>
    <span>
        <button class="link-btn font-bold mr5 hov-s" @click="showDeadlineModal = true">Set Deadline</button>
        <modal :show="showDeadlineModal">
            <div slot="header"></div>
            <div slot="body">
                <p class="f3 col-s ttu">Set a deadline</p>
                <p class="mv4">This deadline should indicate the date by which the candidate process is either terminated, or a job offer is made. You may update the deadline whenever you wish.</p>
                <p v-if="message" class="mv4 col-r">{{ message }}</p>
                <div>
                    <date-picker v-model="deadline"
                                 :inline="true"></date-picker>
                </div>
                <div class="flex justify-end mt4">
                    <button @click="showDeadlineModal = false"
                            class="btn btn-grey">Cancel</button>
                    <button @click="setDeadline"
                            class="btn"
                            :disabled="waiting"
                            :class="{'o-50': waiting}">Set Deadline</button>
                </div>
            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">
    export default {
        props: ['candidate-id'],

        data() {
            return {
                deadline: new Date(),
                waiting: false,
                showDeadlineModal: false,
                message: "",
            };
        },

        methods: {
            setDeadline() {
                this.message = "";
                this.waiting = true;
                axios.post(`/admin/candidates/${this.candidateId}/deadline`, {deadline: this.deadline})
                    .then(() => this.onSuccess())
                    .catch(({response}) => this.onFailure(response))
                    .then(() => this.waiting = false);
            },

            onSuccess() {
                this.$emit('deadline-set');
                this.showDeadlineModal = false;
            },

            onFailure(response) {
                if(response.status === 422) {
                    return this.message = 'The deadline is not valid';
                }
                this.$emit('set-deadline-failed');
                this.showDeadlineModal = false;
            }

        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

</style>