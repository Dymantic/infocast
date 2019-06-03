<template>
    <span>
        <button @click="showModal = true">New Case Study</button>
        <modal :show="showModal">
            <div slot="header"></div>
            <div slot="body">
                <p class="f3">Create a New Case Study</p>
                <vue-form url="/admin/case-studies"
                          :form-model="formModel"
                          @submission-okay="studyCreated"
                >

                    <div slot-scope="{formData, formErrors, waiting}">
                        <div class="form-group mv4"
                             :class="{'has-error': formErrors.title}">
                            <label class="text-sm uppercase text-green font-bold"
                                   for="name">Title</label>
                            <span class="text-xs text-red"
                                  v-show="formErrors.title">{{ formErrors.title }}</span>
                            <input type="text"
                                   name="name"
                                   v-model="formData.title"
                                   class="w-100 db h2 mt1"
                                   id="title">
                        </div>
                        <div class="form-group mv4" :class="{'has-error': formErrors.client}">
                            <label class="text-sm uppercase text-green font-bold" for="client">Client</label>
                            <span class="text-xs text-red" v-show="formErrors.client">{{ formErrors.client }}</span>
                            <input type="text" name="client" v-model="formData.client" class="w-100 db h2 mt1" id="client">
                        </div>
                        <div class="form-group mv4" :class="{'has-error': formErrors.project}">
                            <label class="text-sm uppercase text-green font-bold" for="project">Project Type</label>
                            <span class="text-xs text-red" v-show="formErrors.project">{{ formErrors.project }}</span>
                            <input type="text" name="project" v-model="formData.project" class="w-100 db h2 mt1" id="project">
                        </div>
                        <div>
                            <button type="submit">submit</button>
                        </div>
                    </div>
                </vue-form>
            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">
    import {VueForm, Form} from "@dymantic/vue-forms";

    export default {
        components: {
            VueForm
        },

        data() {
            return {
                showModal: false,
                formModel: new Form({
                    title: '',
                    client: '',
                    project: '',
                })
            };
        },

        methods: {
            studyCreated(data) {
                this.$emit('study-added');
                this.showModal = false;
            }
        }


    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

</style>