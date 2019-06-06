<template>
    <div>
        <div class="hold-on" v-if="!is_ready">Hold on</div>
        <div v-else>
            <div class="editor-container">
                <div class="editor">
                    <h1 class="ph3">{{ post.title }}</h1>
                    <trix-vue ref="editor"
                              @content-changed="onContentChanged"
                              :image-upload-path="`/admin/case-studies/${studyId}/images`"
                              v-model="post.body"
                    ></trix-vue>
                </div>
                <div class="sidebar">
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="title">Title</label>
                        <input class="db w-100 mt1 pv2" type="text" id="title" v-model="post.title">
                    </div>
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="client">Client</label>
                        <input class="db w-100 mt1 pv2" type="text" id="client" v-model="post.client">
                    </div>
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="project_type">Project Type</label>
                        <input class="db w-100 mt1 pv2" type="text" id="project_type" v-model="post.project_type">
                    </div>
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="time_period">When?</label>
                        <input class="db w-100 mt1 pv2" type="text" id="time_period" v-model="post.time_period">
                    </div>
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="intro">Intro</label>
                        <textarea name="intro"
                                  id="intro"
                                  class="db w-100 mt1 pv2 h4"
                                  v-model="post.intro"
                        ></textarea>
                    </div>
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="description">Description (SEO)</label>
                        <textarea name="description"
                                  id="description"
                                  class="db w-100 mt1 pv2 h4"
                                  v-model="post.description"
                        ></textarea>
                    </div>
                    <div class="mv3 ph3">
                        <label class="f6 ttu fw7" for="description">Title Image</label>
                        <image-upload class="mt1" :initial-src="post.title_image_web" :upload-url="`/admin/case-studies/${post.id}/title-image`"></image-upload>
                    </div>
                </div>
                <div class="action-bar flex justify-between items-center ph3 col-p-bg col-w">
                    <div>
                        <div class="flex items-center">

                            <svg v-if="!post.is_draft" xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 24" class="mr3 col-green"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>

                            <svg v-if="post.is_draft" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="mr3 col-r"><path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none"/><path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/></svg>
                            <p class="mr3">{{publish_status }}</p>
                            <button
                                :disabled="waiting_publish"
                                :class="{'o-50': waiting_publish}"
                                class="bn col-w-bg col-p pv1 ph2 hov-s-bg br3"
                                @click="publish"
                                v-if="post.is_draft"
                            >Publish</button>
                            <button
                                :disabled="waiting_publish"
                                :class="{'o-50': waiting_publish}"
                                class="bn col-w-bg col-p pv1 ph2 hov-s-bg br3"
                                @click="retract"
                                v-if="!post.is_draft"
                            >Retract</button>
                        </div>

                    </div>
                    <div class="flex justify-end items-center">
                        <span class="mr3">{{ last_save_status }}</span>
                        <button
                            @click="savePost"
                            class="bn col-w-bg col-p pv1 ph2 hov-s-bg br3"
                        >Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script type="text/babel">
    import {ImageUpload} from "@dymantic/imagineer";
    import TrixVue from "@dymantic/vue-trix-editor";
    import {fetchCaseStudy, saveCaseStudy, publishCaseStudy, retractCaseStudy} from "../../lib/CaseStudies/CaseStudies";

    export default {
        components: {
            ImageUpload,
            TrixVue
        },

        props: ['study-id'],

        data() {
            return {
                is_ready: false,
                waiting_publish: false,
                saving: false,
                is_dirty: false,
                last_saved: null,
                last_save_status: '',
                post: {

                }
            };
        },

        computed: {
            publish_status() {
                if(this.post.is_draft) {
                    return 'This case study is a draft and not visible to the public.'
                }

                return 'This case study is live and publicly visible.'
            },
        },

        watch: {
            post: {
                deep: true,

                handler(a,b) {
                    console.log('changed meta');
                }

            }
        },

        mounted() {
            fetchCaseStudy(this.studyId)
                .then(post => {
                    this.post = post;
                    this.is_ready = true
                });

            window.setInterval(() => this.doSaveRoutine(), 10000)
        },

        methods: {
            savePost() {
                const caseStudy = {
                    id: this.studyId,
                    title: this.post.title,
                    client: this.post.client,
                    project_type: this.post.project_type,
                    time_period: this.post.time_period,
                    intro: this.post.intro,
                    description: this.post.description,
                    body: this.$refs.editor.content()
                };
                saveCaseStudy(caseStudy)
                    .then(data => {
                        this.last_saved = new Date();
                        this.updateSaveStatus();
                    })
                    .catch(() => console.log('shit'));
            },

            publish() {
                this.waiting_publish = true;
                publishCaseStudy(this.studyId)
                    .then(() => this.post.is_draft = false)
                    .then(() => this.waiting_publish = false);
            },

            retract() {
                this.waiting_publish = true;
                retractCaseStudy(this.studyId)
                    .then(() => this.post.is_draft = true)
                    .then(() => this.waiting_publish = false);
            },

            onContentChanged() {
                console.log('changed')
            },

            updateSaveStatus() {
                if(this.last_saved === null) {
                    return this.last_save_status =  ''
                }

                const minute = 60 * 1000;
                const now = new Date();

                if((now.getTime() - this.last_saved.getTime()) < minute) {
                    return this.last_save_status =  'Last saved less than a minute ago';
                }

                this.last_save_status =  `Last saved at ${this.last_saved.toTimeString().slice(0,5)}`
            },

            doSaveRoutine() {
                if(this.is_dirty) {
                    return this.savePost();
                }
                this.updateSaveStatus();
            }
        }
    }
</script>

<style scoped lang="css" type="text/css">
    .editor-container {
        height: calc(100vh - 4rem);
        display: flex;
    }

    .editor {
        flex: 1;
        padding: 2rem;
        padding-bottom: 6rem;
        overflow-y: auto;
    }

    .sidebar {
        width: 380px;
        background: #efefef;
        overflow-y: auto;
        padding-bottom: 6rem;
    }

    .action-bar {
        position: fixed;
        height: 3rem;
        width: 100%;
        bottom: 0;
    }

</style>