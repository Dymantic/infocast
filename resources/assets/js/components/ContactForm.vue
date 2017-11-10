<template>
    <div>
        <form action=""
              class="mh2"
              @submit.stop.prevent="submit"
        >
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.first_name}">
                <span class="f6 col-r"
                      v-show="form.errors.first_name">{{ form.errors.first_name }}</span>
                <input type="text"
                       name="first_name"
                       required
                       v-model="form.data.first_name"
                       id="first_name"
                       class="w-100 input pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="first_name">First Name</label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.last_name}">
                <span class="f6 col-r"
                      v-show="form.errors.last_name">{{ form.errors.last_name }}</span>
                <input type="text"
                       name="last_name"
                       required
                       v-model="form.data.last_name"
                       id="last_name"
                       class="w-100 input pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="last_name">Last Name</label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.email}">

                <span class="f6 col-r"
                      v-show="form.errors.email">{{ form.errors.email }}</span>
                <input type="email"
                       name="email"
                       required
                       id="email"
                       v-model="form.data.email"
                       class="w-100 input pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="email">Email address</label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.phone}">

                <span class="f6 col-r"
                      v-show="form.errors.phone">{{ form.errors.phone }}</span>
                <input type="text"
                       name="phone"
                       required
                       v-model="form.data.phone"
                       id="phone"
                       class="w-100 input pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="phone">Phone Number</label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.inquiry}">
                <span class="f6 col-r"
                      v-show="form.errors.inquiry">{{ form.errors.inquiry }}</span>
                <textarea name="notes"
                          v-model="form.data.inquiry"
                          class="w-100 input h5 pt2 pl2 input ba br2"
                          required
                          id="inquiry"
                >
                </textarea>
                <label class="f6 ttu col-p"
                       for="inquiry">Your inquiry</label>
            </div>
            <div class="mw6 center tc mv5">
                <button type="submit"
                        class="f3 ttu col-p dib center reg-type link col-s pv2 ph4 col-w-bg">Submit Inquiry
                </button>
            </div>
        </form>
    </div>
</template>

<script type="text/babel">
    import Form from "./Form";
    import formMixin from "./mixins/formMixin";

    export default {

        mixins: [formMixin],

        data() {
            return {
                form: new Form({
                    first_name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    inquiry: ''
                })
            };
        },

        mounted() {
          eventHub.$on('inquiry-submitted', this.redirect);
        },

        methods: {

            canSubmit() {
                return true;
            },

            getUpdatedDataFromResponseData(response) {
                return {url: response.redirect_url};
            },

            getStoreActionEventName() {
                return 'inquiry-submitted';
            },

            getUpdateActionEventName() {
                return 'inquiry-updated'
            },

            redirect({url}) {
                console.log('name: ' + this.form.data.first_name);
                window.location = url;
            }

        }

    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

    @import "~@/_variables.scss";

    button[type=submit] {
        border: 1px solid $site_secondary;

        &:hover {
            background-color: $site_light;
            color: $site_red;
            border-color: $site_red;
        }
    }
</style>