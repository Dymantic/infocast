<template>
    <span>
        <button class="btn" @click="showModal = true">New Case Study</button>
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
                        <div class="form-group mv4" :class="{'has-error': formErrors.project_type}">
                            <label class="text-sm uppercase text-green font-bold" for="project_type">Project Type</label>
                            <span class="text-xs text-red" v-show="formErrors.project_type">{{ formErrors.project_type }}</span>
                            <input type="text" name="project_type" v-model="formData.project_type" class="w-100 db h2 mt1" id="project_type">
                        </div>
                        <div class="flex justify-end">
                            <button class="btn btn-grey mr3" @click="showModal = false" type="button">Cancel</button>
                            <button class="btn" type="submit">Submit</button>
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
                    project_type: '',
                })
            };
        },

        methods: {
            studyCreated(data) {
                this.$emit('study-added', data);
                this.showModal = false;
            }
        }


    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

</style>