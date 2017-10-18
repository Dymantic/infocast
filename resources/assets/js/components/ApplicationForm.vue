<template>
    <div>
        <form action=""
              class="mh2"
              @submit.stop.prevent="submit"
        >
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.first_name}">
                <span class="f6 col-r"
                      v-show="form.errors.first_name">{{ form.errors.first_name }}</span>
                <input type="text"
                       name="first_name"
                       required
                       v-model="form.data.first_name"
                       id="first_name"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="first_name">First Name</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.last_name}">
                <span class="f6 col-r"
                      v-show="form.errors.last_name">{{ form.errors.last_name }}</span>
                <input type="text"
                       name="last_name"
                       required
                       v-model="form.data.last_name"
                       id="last_name"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="last_name">Last Name</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.email}">

                <span class="f6 col-r"
                      v-show="form.errors.email">{{ form.errors.email }}</span>
                <input type="email"
                       name="email"
                       required
                       id="email"
                       v-model="form.data.email"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="email">Email address</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.phone}">

                <span class="f6 col-r"
                      v-show="form.errors.phone">{{ form.errors.phone }}</span>
                <input type="text"
                       name="phone"
                       required
                       v-model="form.data.phone"
                       id="phone"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="phone">Phone Number</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.contact_method}">
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
                       for="contact_method">Preferred Contact Method</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.gender}">
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
                    <option value="homo">Homo</option>
                </select>
                <label class="f6 ttu col-p"
                       for="gender">Gender</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.date_of_birth}">
                <span class="f6 col-r"
                      v-show="form.errors.date_of_birth">{{ form.errors.date_of_birth }}</span>
                <input type="text"
                       name="date_of_birth"
                       required
                       v-model="form.data.date_of_birth"
                       id="date_of_birth"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="date_of_birth">Date of Birth (mm/dd/yyyy)</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.prev_company}">
                <span class="f6 col-r"
                      v-show="form.errors.prev_company">{{ form.errors.prev_company }}</span>
                <input type="text"
                       name="prev_company"
                       required
                       v-model="form.data.prev_company"
                       id="prev_company"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="prev_company">Current/Previous Company</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.prev_position}">
                <span class="f6 col-r"
                      v-show="form.errors.prev_position">{{ form.errors.prev_position }}</span>
                <input type="text"
                       name="prev_position"
                       required
                       v-model="form.data.prev_position"
                       id="prev_position"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="prev_position">Current/Previous Position</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.university}">
                <span class="f6 col-r"
                      v-show="form.errors.university">{{ form.errors.university }}</span>
                <input type="text"
                       name="university"
                       required
                       v-model="form.data.university"
                       id="university"
                       class="w-100 input h3 pl2 ba br2 input">
                <label class="f6 ttu col-p"
                       for="university">University/College Name</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.qualifications}">
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
                       for="qualifications">Qualifications</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.skills}">
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
                       for="skills">Skills to highlight</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.english_ability}">
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
                       for="english_ability">English ability</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.mandarin_ability}">
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
                       for="mandarin_ability">Mandarin ability</label>
            </div>
            <div class="form-group mv4 floating-label-input mw6 center"
                 :class="{'has-error': form.errors.notes}">
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
                       for="notes">Message/Notes</label>
            </div>
            <div class="mv4 flex justify-between mw6 center">
                <file-attachment unique="avatar"
                                 file-name="Avatar"
                                 file-type="image"
                                 upload-name="avatar"
                                 upload-url="/applications/uploads/avatars"
                                 initial_image="/images/default_avatar.svg"
                                 @file-attached="setAvatar"
                ></file-attachment>
                <file-attachment unique="cover_letter"
                                 file-name="Cover letter"
                                 file-type="document"
                                 upload-name="cover_letter"
                                 upload-url="/applications/uploads/cover-letters"
                                 initial_image="/images/default_doc.svg"
                                 @file-attached="setCoverLetter"
                ></file-attachment>
                <file-attachment unique="cv"
                                 file-name="Your CV"
                                 file-type="document"
                                 upload-name="cv"
                                 upload-url="/applications/uploads/cvs"
                                 initial_image="/images/default_doc.svg"
                                 @file-attached="setCV"
                ></file-attachment>
            </div>

            <div class="mw6 center tc mv4">
                <button type="submit"
                        class="f3 ttu col-p dib center link col-s pv2 ph4 col-w-bg">Submit Application
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
            }
        },

        mounted() {
            eventHub.$on('application-submitted', () => window.location = '/');
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
                return true;
            },

            getUpdatedDataFromResponseData(response) {
                return {};
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

    button[type=submit] {
        border: solid;
        border-color: currentColor;

        &:hover {
            background-color: #0096D5;
            color: #fff;
            border-color: #0096D5;
        }
    }
</style>