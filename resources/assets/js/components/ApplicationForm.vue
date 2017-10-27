<template>
    <div>
        <form action=""
              class="mh2 mb6"
              @submit.stop.prevent="submit"
              novalidate
        >
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.first_name}"
                 v-if="fieldRequirements.first_name !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.first_name">{{ form.errors.first_name }}</span>
                <input type="text"
                       name="first_name"
                       required
                       v-model="form.data.first_name"
                       id="first_name"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f7 ttu col-p"
                       for="first_name">First Name
                    <span v-if="fieldRequirements.first_name === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.last_name}"
                 v-if="fieldRequirements.last_name !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.last_name">{{ form.errors.last_name }}</span>
                <input type="text"
                       name="last_name"
                       required
                       v-model="form.data.last_name"
                       id="last_name"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f7 ttu col-p"
                       for="last_name">Last Name
                    <span v-if="fieldRequirements.last_name === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.email}"
                 v-if="fieldRequirements.email !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.email">{{ form.errors.email }}</span>
                <input type="email"
                       name="email"
                       required
                       id="email"
                       v-model="form.data.email"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="email">Email address
                    <span v-if="fieldRequirements.email === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.phone}"
                 v-if="fieldRequirements.phone !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.phone">{{ form.errors.phone }}</span>
                <input type="text"
                       name="phone"
                       required
                       v-model="form.data.phone"
                       id="phone"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="phone">Phone Number
                    <span v-if="fieldRequirements.phone === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.contact_method}"
                 v-if="fieldRequirements.contact_method !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.contact_method">{{ form.errors.contact_method }}</span>
                <select required
                        name="contact_method"
                        v-model="form.data.contact_method"
                        id="contact_method"
                        class="w-100 input h3 pl2 ba br2 ba--black col-bg-trans input">
                    <option disabled
                            value="unselected">Contact method
                    </option>
                    <option value="phone">Phone</option>
                    <option value="email">Email</option>
                </select>
                <label class="f6 ttu col-p"
                       for="contact_method">Preferred Contact Method
                    <span v-if="fieldRequirements.contact_method === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.gender}"
                 v-if="fieldRequirements.gender !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.gender">{{ form.errors.gender }}</span>
                <select required
                        name="gender"
                        v-model="form.data.gender"
                        id="gender"
                        class="w-100 input h3 pl2 ba br2 ba--black col-bg-trans input">
                    <option disabled
                            value="unselected">Gender
                    </option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label class="f6 ttu col-p"
                       for="gender">Gender
                    <span v-if="fieldRequirements.gender === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.date_of_birth}"
                 v-if="fieldRequirements.date_of_birth !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.date_of_birth">{{ form.errors.date_of_birth }}</span>
                <input type="text"
                       name="date_of_birth"
                       required
                       v-model="form.data.date_of_birth"
                       id="date_of_birth"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="date_of_birth">Date of Birth (mm/dd/yyyy)
                    <span v-if="fieldRequirements.date_of_birth === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.prev_company}"
                 v-if="fieldRequirements.prev_company !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.prev_company">{{ form.errors.prev_company }}</span>
                <input type="text"
                       name="prev_company"
                       required
                       v-model="form.data.prev_company"
                       id="prev_company"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="prev_company">Current/Previous Company
                    <span v-if="fieldRequirements.prev_company === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.prev_position}"
                 v-if="fieldRequirements.prev_position !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.prev_position">{{ form.errors.prev_position }}</span>
                <input type="text"
                       name="prev_position"
                       required
                       v-model="form.data.prev_position"
                       id="prev_position"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="prev_position">Current/Previous Position
                    <span v-if="fieldRequirements.prev_position === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.university}"
                 v-if="fieldRequirements.university !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.university">{{ form.errors.university }}</span>
                <input type="text"
                       name="university"
                       required
                       v-model="form.data.university"
                       id="university"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="university">University/College Name
                    <span v-if="fieldRequirements.university === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.qualifications}"
                 v-if="fieldRequirements.qualifications !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.qualifications">{{ form.errors.qualifications }}</span>
                <textarea name="qualifications"
                          v-model="form.data.qualifications"
                          class="w-100 input h5 pt4 pl2 input ba br2"
                          required
                          id="qualifications"
                >
                </textarea>
                <label class="f6 ttu col-p"
                       for="qualifications">Qualifications
                    <span v-if="fieldRequirements.qualifications === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.skills}"
                 v-if="fieldRequirements.skills !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.skills">{{ form.errors.skills }}</span>
                <textarea name="skills"
                          v-model="form.data.skills"
                          class="w-100 input h5 pt4 pl2 input ba br2"
                          required
                          id="skills"
                >
                </textarea>
                <label class="f6 ttu col-p"
                       for="skills">Skills to highlight
                    <span v-if="fieldRequirements.skills === 'required'">&ast;</span>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.english_ability}"
                 v-if="fieldRequirements.english_ability !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.english_ability">{{ form.errors.english_ability }}</span>
                <select required
                        name="english_ability"
                        v-model="form.data.english_ability"
                        id="english_ability"
                        class="w-100 input h3 pl2 ba br2 ba--black col-bg-trans input">
                    <option disabled
                            value="unselected">English ability
                    </option>
                    <option value="poor">Poor</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="excellent">Excellent</option>
                </select>
                <label class="f6 ttu col-p"
                       for="english_ability">English ability
                    <span v-if="fieldRequirements.english_ability === 'required'">&ast;</span></label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.mandarin_ability}"
                 v-if="fieldRequirements.mandarin_ability !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.mandarin_ability">{{ form.errors.mandarin_ability }}</span>
                <select required
                        name="mandarin_ability"
                        v-model="form.data.mandarin_ability"
                        id="mandarin_ability"
                        class="w-100 input h3 pl2 ba br2 ba--black col-bg-trans input">
                    <option disabled
                            value="unselected">Mandarin ability
                    </option>
                    <option value="poor">Poor</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="excellent">Excellent</option>
                </select>
                <label class="f6 ttu col-p"
                       for="mandarin_ability">Mandarin ability
                    <span v-if="fieldRequirements.mandarin_ability === 'required'">&ast;</span></label>
                </label>
            </div>
            <div class="form-group mv3 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.notes}"
                 v-if="fieldRequirements.notes !== 'hidden'"
            >
                <span class="f6 col-r"
                      v-show="form.errors.notes">{{ form.errors.notes }}</span>
                <textarea name="notes"
                          v-model="form.data.notes"
                          class="w-100 input h5 pt4 pl2 input ba br2"
                          required
                          id="notes"
                >
                </textarea>
                <label class="f6 ttu col-p"
                       for="notes">Message/Notes
                    <span v-if="fieldRequirements.notes === 'required'">&ast;</span></label>
                </label>
            </div>
            <p class="f7 f6-ns tc mw6 mt4 center">Click (or drag and drop) on the boxes below to attach the following files to your application.</p>
            <div class="mv4 flex-ns justify-between mw6 center">
                <file-attachment unique="avatar"
                                 file-name="Avatar"
                                 file-type="image"
                                 upload-name="avatar"
                                 upload-url="/applications/uploads/avatars"
                                 initial_image="/images/default_avatar.svg"
                                 @file-attached="setAvatar"
                                 v-if="fieldRequirements.avatar !== 'hidden'"
                                 :is-required="fieldRequirements.avatar === 'required'"
                ></file-attachment>
                <file-attachment unique="cover_letter"
                                 file-name="Cover letter"
                                 file-type="document"
                                 upload-name="cover_letter"
                                 upload-url="/applications/uploads/cover-letters"
                                 initial_image="/images/default_doc.svg"
                                 @file-attached="setCoverLetter"
                                 v-if="fieldRequirements.cover_letter !== 'hidden'"
                                 :is-required="fieldRequirements.cover_letter === 'required'"
                ></file-attachment>
                <file-attachment unique="cv"
                                 file-name="Your CV"
                                 file-type="document"
                                 upload-name="cv"
                                 upload-url="/applications/uploads/cvs"
                                 initial_image="/images/default_doc.svg"
                                 @file-attached="setCV"
                                 v-if="fieldRequirements.cv !== 'hidden'"
                                 :is-required="fieldRequirements.cv === 'required'"
                ></file-attachment>
            </div>

            <div class="mw6 center tc mv5">
                <button type="submit"
                        class="f3 ttu col-p dib reg-type center link col-s pv2 ph4 col-w-bg">Submit Application
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

        props: {
            'posting-id': {
                type: Number,
                required: true
            },
            'field-requirements': {
                type: Object,
                required: true
            }
        },

        mounted() {
            eventHub.$on('application-submitted', ({url}) => window.location = url);
            this.$on('failed-validation', () => eventHub.$emit('user-alert', {
                type: 'error',
                title: 'Check your input',
                text: 'Some fields were invalid, or required fields are missing. Check error messages for details.'
            }));
        },

        data() {
            return {
                form: new Form({
                    posting_id: this.postingId,
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    contact_method: '',
                    gender: '',
                    date_of_birth: '',
                    prev_company: '',
                    prev_position: '',
                    university: '',
                    qualifications: '',
                    skills: '',
                    english_ability: '',
                    mandarin_ability: '',
                    notes: '',
                    avatar: null,
                    cv: null,
                    cover_letter: null
                })
            };
        },

        methods: {
            canSubmit() {
                const missing_fields = Object.keys(this.fieldRequirements)
                                             .filter(field => this.fieldRequirements[field] === 'required')
                                             .filter(field => !this.form.data[field])
                                             .map(field => field.replace(/\_/g, ' '));

                if(missing_fields.length > 0) {
                    eventHub.$emit('user-alert', {
                        type: 'warning',
                        title: 'Missing Data',
                        text: `The following fields are required: ${missing_fields.join(', ')}`
                    });

                    return false;
                }
                return true;
            },

            getUpdatedDataFromResponseData(response) {
                return {url: response.redirect_url};
            },

            getStoreActionEventName() {
                return 'application-submitted';
            },

            getUpdateActionEventName() {
                return 'application-updated'
            },

            setAvatar({file_id}) {
                this.form.data.avatar = file_id;
            },

            setCoverLetter({file_id}) {
                this.form.data.cover_letter = file_id;
            },

            setCV({file_id}) {
                this.form.data.cv = file_id;
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

    select {
        background-color: #fff;
        -webkit-appearance: none;
    }
</style>