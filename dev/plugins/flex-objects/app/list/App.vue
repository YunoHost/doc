<template>
    <div>
        <flex-filter-bar :store="store" />
        <flex-content-loader :store="store" v-show="loading" />
        <flex-table :store="store" v-model="loading" v-show="!loading" />
    </div>
</template>

<script>
    import FlexTable from './components/Table.vue';
    import FlexFilterBar from './components/FilterBar.vue';
    import FlexContentLoader from './components/ContentLoader.vue';

    export default {
        props: ['initialStore'],
        components: {FlexTable, FlexFilterBar, FlexContentLoader},
        data: () => ({
            perPage: 10,
            loading: true
        }),
        computed: {
            store() {
                return JSON.parse(this.initialStore || '{}');
            }
        }
    }
</script>
