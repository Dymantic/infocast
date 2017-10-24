<template>
    <div>
        <p class="col-s ttu">Application Fields <span class="col-r" v-show="syncing">...syncing</span></p>
        <table class="w-100">
            <thead>
                <tr>
                    <th class="tl col-p">Field</th>
                    <th class="tl col-p">Required</th>
                    <th class="tl col-p">Optional</th>
                    <th class="tl col-p">Hidden</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(field_value, field_name) in fields" :key="field_name">
                    <td class="ttc">{{ field_name.replace('_', ' ') }}</td>
                    <td>
                        <input value="required"
                               type="radio"
                               @change="sync"
                               :id="`${field_name}_required`"
                               v-model="fields[field_name]">
                        <label :for="`${field_name}_required`"></label>
                    </td>
                    <td>
                        <input value="optional"
                               type="radio"
                               @change="sync"
                               :id="`${field_name}_optional`"
                               v-model="fields[field_name]">
                        <label :for="`${field_name}_optional`"></label>
                    </td>
                    <td>
                        <input value="hidden"
                               type="radio"
                               @change="sync"
                               :id="`${field_name}_hidden`"
                               v-model="fields[field_name]">
                        <label :for="`${field_name}_hidden`"></label>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['application-fields', 'sync-url'],

        data() {
            return {
                syncing: false,
                fields: this.applicationFields
            };
        },

        methods: {
            sync() {
                this.syncing = true;
                axios.post(this.syncUrl, this.fields)
                    .then(({data}) => this.fields = data)
                    .catch(() => this.showError())
                    .then(() => this.syncing = false);
            },

            showError() {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Error',
                    text: 'There was a problem saving your changes. Please refresh and try again.'
                });
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

    @import "~@/_variables.scss";

    label:after {
        content: '';
        display: inline-block;
        height: 1rem;
        width: 1rem;
        border: 1px solid $mid_grey;
        margin-left: .5rem;
        vertical-align: top;
        transition: .4s;
    }

    input[type=radio]:checked + label:after {
        background-color: $admin-secondary;
    }

    input[type=radio] {
        display: none;
    }

    table tr:hover {
        background-color: rgba($admin-secondary, .1);
    }

</style>