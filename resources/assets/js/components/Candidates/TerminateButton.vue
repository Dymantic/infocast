<template>
    <span>
        <button class="btn"
                @click="showTerminateForm = true">Terminate</button>
        <modal :show="showTerminateForm">
            <div slot="header"></div>
            <div slot="body">
                <form action=""
                      @submit.prevent="terminateCandidate">
                <p class="f3 col-s">Terminate the candidate process?</p>
                <p class="">This will terminate the tracking of this candidate. Be sure that you want to do this before you continue.</p>
                <div>
                    <p class="col-s">Who decided to terminate?</p>
                    <div>
                        <label for="infocast_terminated">Infocast</label>
                        <input type="radio"
                               name="terminated_by"
                               v-model="terminated_by"
                               value="infocast"
                               id="infocast_terminated">
                        <label class="ml4"
                               for="self_terminated">Candidate</label>
                        <input type="radio"
                               name="terminated_by"
                               v-model="terminated_by"
                               value="self"
                               id="self_terminated">
                    </div>
                </div>
                <div class="mv3">
                    <label class="db mb2 col-s"
                           for="reason">Provide an optional reason?</label>
                    <input type="text"
                           v-model="reason"
                           class="w-100 pa2">
                </div>
                <div class="flex justify-end items-center mt4">
                    <button type="button"
                            class="btn btn-grey"
                            @click="showTerminateForm = false">Cancel</button>
                    <button type="submit"
                            class="btn ml3">Terminate</button>
                </div>
                    </form>
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
                showTerminateForm: false,
                terminated_by: 'infocast',
                reason: ''
            };
        },

        methods: {
            terminateCandidate() {
                axios.post(`/admin/candidates/${this.candidateId}/terminate`, {
                    terminated_by: this.terminated_by,
                    terminated_reason: this.reason
                })
                    .then(({data}) => this.onTerminated(data))
                    .catch(() => {});
            },

            onTerminated() {
                this.$emit('candidate-terminated');
                this.showTerminateForm = false;
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

</style>