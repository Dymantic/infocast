<template>
    <div class="editor-container">
        <div class="editor">
            <h1 class="ph3">{{ post.title }}</h1>
            <trix-vue v-model="post.body"></trix-vue>
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
                <label class="f6 ttu fw7" for="project">Project</label>
                <input class="db w-100 mt1 pv2" type="text" id="project" v-model="post.project">
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
        <div class="action-bar"></div>
    </div>
</template>

<script type="text/babel">
    import {ImageUpload} from "@dymantic/imagineer";
    import TrixVue from "@dymantic/vue-trix-editor";

    export default {
        components: {
            ImageUpload,
            TrixVue
        },

        props: ['study-id'],

        data() {
            return {
                post: {
                    id: 1,
                    title: 'Hey Jude',
                    client: 'The Beatles',
                    project: 'Abbey Road',
                    time_period: 'Late 60s',
                    intro: 'This is just the beginning',
                    description: 'I will tell you all about it',
                    body: 'Look at my sexy body'
                }
            };
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