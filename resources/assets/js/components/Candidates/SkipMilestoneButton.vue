<template>
    <span>
        <button class="btn btn-grey" @click="showSkipModal = true">Skip</button>
        <modal :show="showSkipModal">
            <div slot="header"></div>
            <div slot="body">
                <p class="col-s f3 ttu">Skip {{ name }}</p>
                <p class="mv4">Skip this step to move the process on to the next step. This step will be considered complete (but noted as skipped).</p>
                <div class="flex justify-end">
                    <button @click="showSkipModal = false" class="btn btn-grey">Cancel</button>
                    <button @click="skipMilestone" class="btn" :disabled="waiting" :class="{'o-50': waiting}">Skip Step</button>
                </div>
            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">
    export default {
        props: ['name', 'url'],

        data() {
            return {
                showSkipModal: false,
                waiting: false,
            };
        },

        methods: {
            skipMilestone() {
                this.waiting = true;
                axios.post(this.url, {skipped: true})
                    .then(() => this.onSuccess())
                    .catch(() => this.onFailure())
                    .then(() => this.waiting = false);
            },

            onSuccess() {
                this.showSkipModal = false;
                this.$emit('milestone-skipped');
            },

            onFailure() {
                this.showSkipModal = false;
                this.$emit('failed-milestone-skipped');
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>