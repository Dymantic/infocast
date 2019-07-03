<template>
    <div>
        <div v-if="status === null"></div>
        <div v-else>
            <div class="flex justify-between items-center">
                <h1 class="f1 normal">{{ candidate.full_name }}</h1>
                <div class="flex justify-end items-center">
                    <terminate-button v-if="status.ongoing"
                                      :candidate-id="candidate.id"
                                      @candidate-terminated="terminated"
                                      @termination-failed="terminationError"
                    ></terminate-button>
                </div>
            </div>
            <section class="card flex justify-between">
                <div>
                    <p class="ttu f6 col-s mb0">Candidate for</p>
                    <p class="f4 mt2">{{ candidate.position }}</p>

                    <p class="ttu f6 col-s mb0">Email</p>
                    <p class="f4 mt2"><a class="col-p no-underline"
                                         :href="`mailto:${candidate.email}`">{{ candidate.email }}</a></p>

                    <p class="ttu f6 col-s mb0">Phone</p>
                    <p class="f4 mt2">{{ candidate.phone }}</p>
                </div>
                <div class="flex flex-column justify-around">
                    <a :href="`/admin/applications/${candidate.application_id}`"
                       class="no-underline items-center btn">See application</a>
                    <a v-if="candidate.cover_letter_link"
                       :href="candidate.cover_letter_link"
                       :download="candidate.cover_letter_name"
                       class="btn no-underline items-center mt3"
                    >Cover Letter</a>
                    <a v-if="candidate.cv_link"
                       :href="candidate.cv_link"
                       :download="candidate.cv_name"
                       class="btn no-underline items-center mt3"
                    >Resume</a>
                </div>


            </section>
            <section v-if="status.terminated"
                     class="card mv4 flex justify-between">
                <div>
                    <p class="ttu f6 col-s">Status</p>
                    <p class="f4">Terminated</p>
                    <p v-if="status.terminated_reason">{{ status.terminated_reason }}</p>
                </div>
                <div>
                    <p class="ttu f6 col-s">Terminated by</p>
                    <p class="f4">{{ status.terminated_by }}</p>
                </div>
            </section>

            <section v-if="status.ongoing"
                     class="card mv4 flex justify-between">
                <div>
                    <p class="ttu f6 col-s">Status</p>
                    <p class="f4">{{ status.status }}</p>
                </div>
                <div class="flex flex-column justify-end">
                    <p class="ttu f6 col-s mb0">Deadline</p>
                    <p class="f4 mt2">{{ status.deadline }}</p>
                    <set-deadline-button :candidate-id="candidate.id"
                                         @deadline-set="deadlineSet"
                                         @set-deadline-failed="deadlineError"
                    ></set-deadline-button>
                </div>
            </section>

            <section v-if="status.job_offered && !status.finalised"
                     class="card mv4 flex justify-between">
                <div>
                    <p class="ttu f6 col-s">Status</p>
                    <p class="f4">Job Offered</p>
                </div>
                <div class="flex flex-column justify-around">
                    <finalise-button :accept="true"
                                     :candidate-id="candidate.id"
                                     @finalise-failed="finaliseError"
                                     @job-accepted="finaliseAccepted"
                    ></finalise-button>
                    <finalise-button :accept="false"
                                     :candidate-id="candidate.id"
                                     @finalise-failed="finaliseError"
                                     @job-rejected="finaliseRejected"
                    ></finalise-button>
                </div>
            </section>

            <section v-if="status.finalised"
                     class="card mv4">
                <div>
                    <p class="ttu f6 col-s">Status</p>
                    <p class="f4">Job Offered {{ status.accepted ? 'Accepted' : 'Rejected' }}</p>
                </div>

            </section>

            <section v-if="status.ongoing"
                     class="card mv4 flex justify-between">
                <div>
                    <p class="ttu f6 col-s">Next Step</p>
                    <p class="f4">{{ status.next_milestone.name }}</p>
                </div>
                <div class="flex flex-column justify-end">
                    <mark-milestone-button :url="status.next_milestone.url"
                                           :date-field-name="status.next_milestone.date_field_name"
                                           :name="status.next_milestone.name"
                                           @milestone-marked="milestonePassed"
                                           @failed-milestone-marked="milestoneError"
                    ></mark-milestone-button>
                    <skip-milestone-button :url="status.next_milestone.url"
                                           :name="status.next_milestone.name"
                                           @milestone-skipped="skippedMilestone"
                                           @failed-milestone-skipped="skipError"
                                           class="mt3"
                    ></skip-milestone-button>
                </div>
            </section>
            <section class="card mv4">
                <div>
                    <p class="ttu f6 col-s">Completed Steps</p>
                </div>
                <table class="w-100">
                    <thead>
                    <tr class="pb3">
                        <th class="tl">Date</th>
                        <th class="tl">Step</th>
                        <th class="tl">Logged by</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(milestone, index) in status.completed_milestones"
                        :key="index">
                        <td>{{ milestone.date }}</td>
                        <td>
                            <span>{{ milestone.name }}</span>
                            <span v-if="milestone.skipped"
                                  class="ph4 col-r ttu">Skipped</span>
                        </td>
                        <td>{{ milestone.by }}</td>
                    </tr>
                    </tbody>
                </table>

            </section>
        </div>
    </div>

</template>

<script type="text/babel">
    import TerminateButton from "./TerminateButton";
    import MarkMilestoneButton from "./MarkMilestoneButton";
    import SkipMilestoneButton from "./SkipMilestoneButton";
    import SetDeadlineButton from "./SetDeadlineButton";
    import FinaliseButton from "./FinaliseButton";
    import {notify} from "../Notifications/notify";

    export default {
        components: {
            TerminateButton,
            MarkMilestoneButton,
            SkipMilestoneButton,
            SetDeadlineButton,
            FinaliseButton,
        },

        props: ['candidate'],

        data() {
            return {
                status: null,
            };
        },

        mounted() {
            this.refreshStatus();
        },

        methods: {
            fetchStatus() {
                return new Promise((resolve, reject) => {
                    axios.get(`/admin/candidates/${this.candidate.id}/status`)
                         .then(({data}) => {
                             this.status = data;
                             resolve();
                         })
                         .catch(() => reject({message: "Unable to fetch candidate's status"}));
                })
            },

            refreshStatus() {
                this.fetchStatus().catch(notify.error);
            },

            milestonePassed() {
                notify.success({message: "That step has been marked as completed"});
                this.refreshStatus();
            },

            milestoneError() {
                notify.error({message: "Unable to mark step as complete. Please refresh and try again."});
            },

            skippedMilestone() {
                notify.success({message: "That step has been marked as skipped"});
                this.refreshStatus();
            },

            skipError() {
                notify.error({message: "Unable to mark step as skipped. Please refresh and try again."});
            },

            terminated() {
                notify.success({message: "The hiring process for this candidate has been terminated."});
                this.refreshStatus();
            },

            terminationError() {
                notify.error({message: "Unable to terminate process. Please refresh and try again."});
            },

            deadlineSet() {
                notify.success({message: "The deadline for this candidate has been updated."});
                this.refreshStatus();
            },

            deadlineError() {
                notify.error({message: "Unable to set the deadline. Please refresh and try again."});
            },

            finaliseAccepted() {
                notify.success({message: "The job offer has been marked as accepted"});
                this.refreshStatus();
            },

            finaliseRejected() {
                notify.success({message: "The job offer has been marked as rejected"});
                this.refreshStatus();
            },

            finaliseError() {
                notify.error({message: "Unable to finalise job offer. Please refresh and try again."});
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

</style>