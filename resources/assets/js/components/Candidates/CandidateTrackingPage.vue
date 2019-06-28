<template>
    <div>
        <div class="flex justify-between items-center">
            <h1 class="f1 normal">{{ candidate.full_name }}</h1>
            <div class="flex justify-end items-center">
                <terminate-button :candidate-id="candidate.id"></terminate-button>
            </div>
        </div>
        <section class="card flex justify-between">
            <div>
                <p class="ttu f6 col-s">Candidate for</p>
                <p class="f4">{{ candidate.position }}</p>
            </div>
            <a :href="`/admin/applications/${candidate.application_id}`"
               class="no-underline items-center btn">See application</a>

        </section>
    </div>
</template>

<script type="text/babel">
    import TerminateButton from "./TerminateButton";

    export default {
        components: {
            TerminateButton,
        },

        props: ['candidate']
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>