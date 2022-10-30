<template>
    <div class="container pt-4 pb-4">
        <h2 class="mb-4 red-color">Articles List</h2>
        <div
            v-for="(article, index) in articles"
            :key="index"
            class="row mb-2 pt-4 pb-4 single-article"
        >
            <div class="col-12 col-lg-8 text-white">
                <h4 class="red-color">
                    <a :href="article.link" class="red-color" target="_blank">{{
                        article.title
                    }}</a>
                </h4>
                <p>{{ article.excerpt }}</p>
                <p>{{ article.date }}</p>
            </div>
            <div class="col-12 col-lg-4">
                <img
                    class="img-fluid w-100"
                    :src="article.image_url"
                    loading="lazy"
                    alt="Article Image"
                />
            </div>
        </div>
        <p v-if="articles.length < 1" class="text-white">No articles found</p>
    </div>
</template>

<script>
export default {
    props: {
        successful: Boolean,
        errorMessage: String,
        articles: Array,
    },
    mounted() {},
    data() {
        return {};
    },
};
</script>
<style>
.container {
    background-color: #1f1e1c;
    min-height: 100vh;
}

.red-color {
    color: #c63b12 !important;
}
.single-article {
    border-top: dotted 1px white;
    /* border-bottom: dotted 1px white; */
}
</style>
