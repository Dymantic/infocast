<template>
    <span>
        <button @click="showFinaliseModal = true" class="btn">{{ accept ? "Accepted" : "Rejected" }}</button>
        <modal :show="showFinaliseModal">
            <div slot="header"></div>
            <div slot="body">
                <p class="ttu col-s f3">Mark as {{ accept ? "Accepted" : "Rejected" }}</p>
                <p class="mv4">By marking the offer as {{ accept ? "accepted" : "rejected" }}, this candidate's process will be finalised, and no further actions will be possible.</p>
                <div class="mt4 flex justify-end">
                    <button @click="showFinaliseModal = false" class="btn btn-grey">Cancel</button>
                    <button class="btn" @click="finalise" :disabled="waiting" :class="{'o-50': waiting}">{{ accept ? "Accept" : "reject" }}</button>
                </div>
            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">
    export default {
        props: ['candidate-id', 'accept'],

        data() {
            return {
                showFinaliseModal: false,
                waiting: false,
            };
        },

        methods: {
            finalise() {
                this.waiting = true;
                axios.post(`/admin/candidates/${this.candidateId}/finalise-job-offer`, {accepted: this.accept})
                    .then(() => this.onSuccess())
                    .catch(() => this.onFailure())
                    .then(() => this.waiting = false);
            },

            onSuccess() {
                this.showFinaliseModal = false;
                this.$emit(this.accept ? 'job-accepted' : 'job-rejected');
            },

            onFailure() {
                this.showFinaliseModal = false;
                this.$emit('finalise-failed');
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>