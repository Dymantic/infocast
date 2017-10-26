<template>
    <div>
        <form action="" class=""
              @submit.stop.prevent="submit">
            <div class="card mv3">
                <p class="mw7 center">The title is the only field that is always required. If you wish to not include any field on the site, just leave it blank.</p>
                <p class="mw7 center">Don't forget to publish the posting when it ready.</p>
                <p class="mw7 center">Even once published, the posting won't show on the site if the posted date is set to the future.</p>
            </div>
            <div class="mv4 card">
                <div class="form-group mv3 mw7 center"
                     :class="{'has-error': form.errors.title}">
                    <label class="f6 ttu col-s mb2"
                           for="title">Title</label>
                    <span class="f6 col-r"
                          v-show="form.errors.title">{{ form.errors.title }}</span>
                    <input type="text"
                           name="title"
                           v-model="form.data.title"
                           class="w-100 input h2 pl2">
                </div>
                <div class="form-group mv3 mw7 center"
                     :class="{'has-error': form.errors.type}">
                    <label class="f6 ttu col-s mb2"
                           for="type">Type</label>
                    <span class="f6 col-r"
                          v-show="form.errors.type">{{ form.errors.type }}</span>
                    <input type="text"
                           name="type"
                           v-model="form.data.type"
                           class="w-100 input h2 pl2">
                </div>
                <div class="form-group mv3 mw7 center"
                     :class="{'has-error': form.errors.category}">
                    <label class="f6 ttu col-s mb2"
                           for="category">Category</label>
                    <span class="f6 col-r"
                          v-show="form.errors.category">{{ form.errors.category }}</span>
                    <input type="text"
                           name="category"
                           v-model="form.data.category"
                           class="w-100 input h2 pl2">
                </div>
                <div class="form-group mv3 mw7 center"
                     :class="{'has-error': form.errors.location}">
                    <label class="f6 ttu col-s mb2"
                           for="location">Location</label>
                    <span class="f6 col-r"
                          v-show="form.errors.location">{{ form.errors.location }}</span>
                    <input type="text"
                           name="location"
                           v-model="form.data.location"
                           class="w-100 input h2 pl2">
                </div>
                <div class="form-group mv3 mw7 center"
                     :class="{'has-error': form.errors.compensation}">
                    <label class="f6 ttu col-s mb2"
                           for="compensation">Compensation</label>
                    <span class="f6 col-r"
                          v-show="form.errors.compensation">{{ form.errors.compensation }}</span>
                    <input type="text"
                           name="compensation"
                           v-model="form.data.compensation"
                           class="w-100 input h2 pl2">
                </div>
                <div class="form-group mv3 mw7 center"
                     :class="{'has-error': form.errors.introduction}">
                    <label class="f6 ttu col-s mb2"
                           for="introduction">Introduction</label>
                    <span class="f6 col-r"
                          v-show="form.errors.introduction">{{ form.errors.introduction }}</span>
                    <textarea v-model="form.data.introduction"
                              class="w-100 pa2 ba b--black-30 no-resize h4"></textarea>
                </div>
            </div>
            <div class="mv4 card">
                <div class="flex justify-between mw7 center">
                    <div class="w-40">
                        <div class="form-group mv3"
                             :class="{'has-error': form.errors.posted}">
                            <label class="f6 ttu col-s mb2"
                                   for="posted">Posted</label>
                            <span class="f6 col-r"
                                  v-show="form.errors.posted">{{ form.errors.posted }}</span>
                            <date-picker name="posted"
                                         v-model="form.data.posted"
                                         :clear-button="true"
                            ></date-picker>
                        </div>
                    </div>
                    <div class="w-40">
                        <div class="form-group mv3"
                             :class="{'has-error': form.errors.start_date}">
                            <label class="f6 ttu col-s mb2"
                                   for="start_date">Start date</label>
                            <span class="f6 col-r"
                                  v-show="form.errors.start_date">{{ form.errors.start_date }}</span>
                            <input type="text"
                                   name="start_date"
                                   v-model="form.data.start_date"
                                   class="w-100 input h2 pl2">
                        </div>
                    </div>
                </div>

            </div>
            <div class="mv4 card">
                <p>The following three fields accept markdown as a formatting option.</p>
                <div class="flex justify-between mv3">
                    <div class="w-50 pa2">
                        <div class="form-group"
                             :class="{'has-error': form.errors.job_description}">
                            <label class="f6 ttu col-s mb2"
                                   for="job_description">Job description</label>
                            <span class="f6 col-r"
                                  v-show="form.errors.job_description">{{ form.errors.job_description }}</span>
                            <textarea v-model="form.data.job_description"
                                      class="w-100 pa2 ba b--black-30 no-resize h5"></textarea>
                        </div>
                    </div>
                    <div class="w-50 pa2">
                        <div v-html="marked_description">

                        </div>
                    </div>
                </div>
                <div class="flex justify-between mv3">
                    <div class="w-50 pa2">
                        <div class="form-group"
                             :class="{'has-error': form.errors.responsibilities}">
                            <label class="f6 ttu col-s mb2"
                                   for="responsibilities">Responsibilities</label>
                            <span class="f6 col-r"
                                  v-show="form.errors.responsibilities">{{ form.errors.responsibilities }}</span>
                            <textarea v-model="form.data.responsibilities"
                                      class="w-100 pa2 ba b--black-30 no-resize h4"></textarea>
                        </div>
                    </div>
                    <div class="w-50 pa2">
                        <div v-html="marked_responsibilities">

                        </div>
                    </div>
                </div>
                <div class="flex justify-between mv3">
                    <div class="w-50 pa2">
                        <div class="form-group"
                             :class="{'has-error': form.errors.requirements}">
                            <label class="f6 ttu col-s mb2"
                                   for="requirements">Requirements</label>
                            <span class="f6 col-r"
                                  v-show="form.errors.requirements">{{ form.errors.requirements }}</span>
                            <textarea v-model="form.data.requirements"
                                      class="w-100 pa2 ba b--black-30 no-resize h4"></textarea>
                        </div>
                    </div>
                    <div class="w-50 pa2">
                        <div v-html="marked_requirements">

                        </div>
                    </div>
                </div>
            </div>
            <div class="tr mb5">
                <button class="btn dd-btn"
                        type="submit"
                        :disabled="waiting">
                    <span v-show="!waiting">{{ formType === 'create' ? 'Create Posting' : 'Save Changes' }}</span>
                    <div class="spinner"
                         v-show="waiting">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </button>
            </div>
        </form>
    </div>
</template>

<script type="text/babel">
    import formMixin from "./mixins/formMixin";
    import Form from "./Form";
    import moment from "moment";
    import MarkdownIt from "markdown-it";


    export default {

        mixins: [formMixin],

        data() {
            return {
                form: new Form({
                    title: this.formAttributes.title || '',
                    type: this.formAttributes.type || '',
                    category: this.formAttributes.category || '',
                    location: this.formAttributes.location || '',
                    compensation: this.formAttributes.compensation || '',
                    posted: this.formAttributes.posted || moment().format(),
                    start_date: this.formAttributes.start_date || '',
                    introduction: this.formAttributes.introduction || '',
                    job_description: this.formAttributes.job_description || '',
                    responsibilities: this.formAttributes.responsibilities || '',
                    requirements: this.formAttributes.requirements || ''
                }),
                md: new MarkdownIt()
            };
        },

        computed: {
            marked_description() {
                return this.md.render(this.form.data.job_description);
            },

            marked_requirements() {
                return this.md.render(this.form.data.requirements);
            },

            marked_responsibilities() {
                return this.md.render(this.form.data.responsibilities);
            }
        },

        mounted() {
            eventHub.$on('posting-created', () => window.location = '/admin/postings');
            this.$on('posting-updated', () => window.location = `/admin/postings/${this.formAttributes.id}`);
            this.$on('failed-validation', () => eventHub.$emit('user-alert', {
                type: 'warning',
                title: 'Some fields are invalid.',
                text: 'Some of your input was not valid. See the error messages for more detail.'
            }));
        },

        methods: {

            canSubmit() {
                return true;
            },

            getUpdatedDataFromResponseData(response) {
                return {
                    title: response.title,
                    type: response.type,
                    category: response.category,
                    location: response.location,
                    compensation: response.compensation,
                    posted: response.posted,
                    start_date: response.start_date,
                    introduction: response.introduction,
                    job_description: response.job_description,
                    responsibilities: response.responsibilities,
                    requirements: response.requirements
                };
            },

            getStoreActionEventName() {
                return 'posting-created';
            },

            getUpdateActionEventName() {
                return 'posting-updated'
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

</style>