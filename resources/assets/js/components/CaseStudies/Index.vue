<template>
    <div>
        <div class="flex justify-between items-center">
            <h1 class="f1 normal">Case Studies</h1>
            <div class="flex justify-end items-center">
                <new-study-form @study-added="goToNewStudy"></new-study-form>
            </div>
        </div>
        <div class="pb4">
            <div v-for="study in studies" :key="study.id" class="mv3 col-w-bg pa3">
                <a :href="`/admin/case-studies/${study.id}/edit`" class="col-p hov-s f4 no-underline">
                    <p><strong>Title: </strong>{{ study.title }}</p>
                </a>
                <p><strong>Client: </strong>{{ study.client }}</p>
                <p>{{ study.intro }}</p>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import NewStudyForm from "./NewStudyForm";

    export default {
        components: {
            NewStudyForm
        },

        data() {
            return {
                studies: [],
            };
        },

        mounted() {
            this.fetchStudies();
        },

        methods: {

            fetchStudies() {
                return new Promise((resolve, reject) => {
                    axios.get("/admin/case-studies")
                        .then(({data}) => {
                            this.studies = data;
                            resolve();
                        })
                        .catch(reject);
                });
            },

            goToNewStudy(study) {
                window.location = `/admin/case-studies/${study.id}/edit`;
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>