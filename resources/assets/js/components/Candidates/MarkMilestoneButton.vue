<template>
    <span>
        <button @click="showMilestoneForm = true" class="btn">Done</button>
        <modal :show="showMilestoneForm">
            <div slot="header"></div>
            <div slot="body">
                <p class="ttu col-s f3 mb4">Mark Milestone As Complete</p>
                <p>{{ name}} </p>
                <p v-if="message" class="col-r f4">{{ message }}</p>
                <form action="" @submit.prevent="markMilestone">
                    <div>
                        <date-picker name="milestone_date" :inline="true" v-model="date"></date-picker>
                    </div>
                    <div class="flex justify-end mt5">
                        <button type="button" class="btn btn-grey" @click="showMilestoneForm = false">Cancel</button>
                        <button :disabled="waiting" :class="{'o-50': waiting}" type="submit" class="btn">Do it</button>
                    </div>
                </form>

            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">
    export default {
        props: ['name', 'date-field-name', 'url'],

        data() {
            return {
                showMilestoneForm: false,
                date: new Date(),
                message: '',
                waiting: false,
            };
        },

        methods: {
            markMilestone() {
                this.waiting = true;
                this.message = '';
                const formBody = {};
                formBody[this.dateFieldName] = this.date.toISOString().slice(0, 10);
                axios.post(this.url, formBody)
                    .then(({data}) => this.onSuccess())
                    .catch(err => this.onFailure(err.response))
                    .then(() => this.waiting = false);
            },

            onSuccess() {
                this.showMilestoneForm = false;
                this.$emit('milestone-marked');
                this.date = new Date();
            },

            onFailure(response) {
                console.log(response);
                if(response.status === 422) {
                    return this.message = 'The date you have chosen is not valid!';
                }
                this.showMilestoneForm = false;
                this.$emit('failed-milestone-marked');
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>