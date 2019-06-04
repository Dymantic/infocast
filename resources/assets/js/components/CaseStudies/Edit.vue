<template>
    <div>
        <div class="hold-on" v-if="!is_ready">Hold on</div>
        <div v-else>
            <div class="editor-container">
                <div class="editor">
                    <h1 class="ph3">{{ post.title }}</h1>
                    <trix-vue ref="editor" v-model="post.body"></trix-vue>
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
                <div class="action-bar flex justify-between">
                    <div></div>
                    <div class="flex justify-end items-center">
                        <button @click="savePost">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script type="text/babel">
    import {ImageUpload} from "@dymantic/imagineer";
    import TrixVue from "@dymantic/vue-trix-editor";
    import {fetchCaseStudy, saveCaseStudy} from "../../lib/CaseStudies/CaseStudies";

    export default {
        components: {
            ImageUpload,
            TrixVue
        },

        props: ['study-id'],

        data() {
            return {
                is_ready: false,
                post: {

                }
            };
        },

        mounted() {
            fetchCaseStudy(this.studyId)
                .then(post => {
                    this.post = post;
                    this.is_ready = true
                });
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
                    .then(data => console.log(data))
                    .catch(() => console.log('shit'));
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
        background: deeppink;
    }

</style>