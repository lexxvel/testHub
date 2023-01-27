<template>
    <Head :title="title" />
    <div class="FormTitle">
        <h2>{{title}}</h2>
    </div>
    <spin v-if="loading"></spin>
    <div v-if="!loading" class="runForm">

    </div>
</template>

<script>
export default {
    name: "Edit",
    props: {
        title: String,
        run: Object
    },
    data: () => ({
        loading: false,

    }),
}
</script>

<style scoped>

</style>
