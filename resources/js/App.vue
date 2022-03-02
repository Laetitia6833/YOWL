<template>
    <!-- <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    /> -->
    <router-view></router-view>
</template>

<script>
export default {
    beforeCreate() {
        this.$store.commit("initializeAuth");
    },
    mounted() {
        this.$store.dispatch("getLocations");
        this.$store.dispatch("getProducts");
        this.$store.dispatch("getProducteurs");
        this.$store.dispatch("getBaskets");
    },
};
</script>

<style src="../css/reset.css"></style>
<style>
#app {
    min-height: 100vh;
}
body {
    font-family: sans-serif;
}

.mt {
    padding-top: 100px;
}
</style>
