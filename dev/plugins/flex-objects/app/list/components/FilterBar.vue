<template>
    <div class="search-wrapper">
        <input type="text" class="search" :placeholder="store.searchPlaceholder" v-model.trim="filterText" @input="doFilter">
        <select class="filter-perPage" v-model="store.perPage" @change="changePerPage">
            <option v-for="(value, title) in this.perPageOptions"
                    :value="value"
                    :selected="store.perPage === value">{{ title }}</option>
        </select>
    </div>
</template>

<script>
    import debounce from 'lodash/debounce';

    export default {
        props: ['store'],
        data: () => ({
            filterText: '',
            searchPlaceholder: 'Filter...',
            selected: ''
        }),
        computed: {
            perPageOptions() {
                const options = {
                    '25': 25,
                    '50': 50,
                    '100': 100,
                    '200': 200,
                    'All': ''
                };

                if (!options[this.store.perPage]) {
                    options[this.store.perPage] = this.store.perPage;
                }

                return options;
            }
        },
        created() {
            this.doFilter = debounce(() => {
                this.$events.fire('filter-set', this.filterText);
            }, 250, { leading: false });

            this.changePerPage = () => {
                this.$events.fire('filter-perPage', this.store.perPage);
            };
        },
        methods: {
            resetFilter() {
                this.filterText = '';
                this.$events.fire('filter-reset');
            }
        }
    }
</script>

<style scoped>
    .search-wrapper {
        display: flex;
    }

    .search-wrapper select {
        margin-bottom: 0;
        margin-left: 1rem;
    }
</style>
