<template>
    <div>
        <ul ref="sortlist">
            <li v-for="item in sorted_items" :key="item.id" :data-id="item.id">
                <p>{{ item.name }}</p>
            </li>
        </ul>
    </div>
</template>

<script type="text/babel">

    import Sortable from "sortablejs";

    export default {

        props: ['items', 'url'],

        data() {
            return {
                sortable: null,
                syncing: false
            };
        },

        computed: {
            sorted_items() {
                return this.items.sort((a, b) => a.position - b.position);
            }
        },

        mounted() {
            this.sortable = Sortable.create(this.$refs.sortlist, {
                onSort: () => this.syncChanges()
            });
        },

        methods: {
            syncChanges() {
                console.log(this.sortable.toArray());
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

</style>