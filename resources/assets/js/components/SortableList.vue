<template>
    <div>
        <p>Click and drag the items into the order you wish.</p>
        <ul ref="sortlist" class="list pl0" :class="{'disabled': syncing}">
            <li class="ma2 col-w-bg pl4 mw7" v-for="item in sorted_items" :key="item.id" :data-id="item.id">
                <p class="pv3">{{ item.name }}</p>
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
                this.disable();
                axios.post(this.url, {posting_order: this.sortable.toArray()})
                    .then(() => this.enable())
                    .catch(() => eventHub.$emit('user-error', 'Failed to sync postings order. Please try again later.'))
                    .then(() => this.enable());
            },

            enable() {
                this.sortable.option("disabled", false);
            },

            disable() {
                this.sortable.option("disabled", true);
            }
        }
    }
</script>

<style scoped lang="scss" type="text/scss">

    li {
        cursor: move;
    }

    .disabled {
        opacity: .5;
    }

</style>