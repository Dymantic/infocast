<template>
    <div>
        <p class="tc tl-ns">{{ fileName }} <span v-if="isRequired">&ast;</span></p>
        <div class="h4 w4 center ba b--dotted relative drop-area"
             @drop.prevent="handleDropFile"
             @dragenter.prevent="hover = true"
             @dragover.prevent="hover = true"
             @dragleave="hover = false"
             :class="{'hovering': hover}"
        >
            <label :for="`file_input${unique}`"
                   class="absolute w-100 h4">
                <input type="file"
                       :id="`file_input${unique}`"
                       class="dn"
                       :disabled="uploading"
                       @change="handleFile">
                <img :src="image_src"
                     class="absolute w4 h4 preview-image"
                     alt="file upload preview">
            </label>
            <div class="absolute w-100 bottom-0 progress-bar"
                 :style='{"transform": "scaleX(" + (progress / 100) + ")"}'></div>
        </div>
        <p v-show="received"><span class="col-s">&check; </span>Received</p>
    </div>
</template>

<script type="text/babel">
    import {generatePreview} from "./PreviewGenerator";

    export default {

        props: ['initial_image', 'file-type', 'unique', 'upload-url', 'upload-name', 'file-name', 'is-required'],

        data() {
            return {
                image_src: this.initial_image,
                uploading: false,
                progress: 0,
                received: false,
                last_confirmed: this.initial_image,
                hover: false
            };
        },

        methods: {

            handleFile(ev) {
                const file = ev.target.files[0];

                if (this.isValid(file)) {
                    return this.processFile(file);
                }

                this.showInvalidFile(file);
            },

            handleDropFile(ev) {
                const file = ev.dataTransfer.files[0];

                if (this.isValid(file)) {
                    return this.processFile(file);
                }

                this.showInvalidFile(file);
            },

            isValid(file) {
                if(file.size > 2000000) {
                    return false;
                }

                if (this.fileType === 'image') {
                    return file.type.indexOf('image') !== -1;
                }

                return (file.type.indexOf('docx') !== -1) ||
                    (file.type.indexOf('msword') !== -1) ||
                    (file.type.indexOf('pdf') !== -1) ||
                    (file.type.indexOf('text') !== -1);
            },

            showInvalidFile(file) {
                if(file.size > 2000000) {
                    return this.showError(`${file.name} is too large. Please use a file under 2MB`);
                }
                this.showError(`${file.name} is not a valid ${this.fileType} file.`);
            },

            processFile(file) {
                this.showPreview(file);
                this.uploadFile(file);
            },

            showPreview(file) {
                if (this.fileType === 'image') {
                    generatePreview(file, {pWidth: 300, pHeight: 300})
                        .then((src) => this.image_src = src)
                        .catch((err) => console.log(err));
                    return;
                }

                this.image_src = '/images/uploaded_doc.svg'
            },

            uploadFile(file) {
                this.uploading = true;
                axios.post(this.uploadUrl, this.prepareFormData(file), this.getUploadOptions())
                     .then(res => this.onUploadSuccess(res))
                     .catch(err => this.onUploadFailed(err));
            },

            prepareFormData: function (file) {
                let fd = new FormData();
                fd.append(this.uploadName, file);
                return fd;
            },

            onUploadSuccess(res) {
                this.received = true;
                this.progress = 0;
                this.uploading = false;
                this.last_confirmed = this.image_src;
                this.$emit('file-attached', {file_id: res.data.file_id});
            },

            onUploadFailed(err) {
                this.uploading = false;
                this.progress = 0;
                this.showError('The file upload was not successful. Please ensure you have a valid file, and refresh the page');
                this.image_src = this.last_confirmed;
            },

            getUploadOptions() {
                return {
                    onUploadProgress: (ev) => this.showProgress(parseInt(ev.loaded / ev.total * 100))
                }
            },

            showProgress(progress) {
                this.progress = progress;
            },

            showError(text) {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Oh Snap',
                    text,
                });
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">
    .preview-image {
        z-index: -1;
    }

    .progress-bar {
        height: 3px;
        background-color: #0096D5;
        transform-origin: left top;
    }

    .hovering {
        border-style: solid;
        border-width: 3px;
        border-color: #0096D5;
    }
</style>