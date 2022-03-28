<template>
    <div>
        <div :style="{ height: 300, width: '100%' }"></div>
        <content-loader
            :height="fixedAmount * count"
            :width="1060"
            :speed="2"
            primaryColor="#d9d9d9"
            secondaryColor="#ecebeb"
        >
            <template v-for="index in count">
                <rect x="13" :y="fixedAmount * index + offset" rx="6" ry="6" :width="200 * random()" height="12" />
                <rect x="533" :y="fixedAmount * index + offset" rx="6" ry="6" :width="63 * random()" height="12" />
                <rect x="653" :y="fixedAmount * index + offset" rx="6" ry="6" :width="78 * random()" height="12" />
                <rect x="755" :y="fixedAmount * index + offset" rx="6" ry="6" :width="117 * random()" height="12" />
                <rect x="938" :y="fixedAmount * index + offset" rx="6" ry="6" :width="83 * random()" height="12" />

                <rect x="0" :y="fixedAmount * index" rx="6" ry="6" width="1060" height=".3" />
            </template>
        </content-loader>
    </div>
</template>

<script>
    import { ContentLoader } from 'vue-content-loader';

    export default {
        props: ['store'],
        data: () => ({
            fixedAmount: 31,
            offset: 10,
            steps: [0.7, 0.8, 0.9, 1]
        }),
        computed: {
            count() {
                return this.store.perPage;
            }
        },
        methods: {
            random() {
                return this.steps[Math.floor(Math.random() * this.steps.length)];
            }
        },
        components: {
            ContentLoader
        }
    }
</script>
