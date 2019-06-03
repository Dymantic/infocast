<template>
    <div>
        <div class="flex justify-between items-center">
            <h1 class="f1 normal">Case Studies</h1>
            <div class="flex justify-end items-center">
                <new-study-form @study-added="fetchStudies"></new-study-form>
            </div>
        </div>
        <div class="">
            <div v-for="study in studies" :key="study.id">
                <p>{{ study.title }}</p>
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
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>