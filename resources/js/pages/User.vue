<template>
    <div>
        <Navbar />
        <h4>Content de vous revoir {{ user.name }} !</h4>

        <h6>Consulter et modifier mes informations :</h6>
        <div class="user-info">
            <label for="nom-utilisateur">Nom utilisateur :</label>
            {{ user.name }} <br />
            <label for="email-utilisateur">Votre email :</label>
            {{ user.email }} <br />
            <label for="location-utilisateur">Votre département :</label>
        </div>
    </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
export default {
    components: {
        Navbar,
    },
    computed: {
        user() {
            return this.$store.state.user;
        },
        // location() {
        //     return this.$store.state.locations;
        // },
    },
    mounted() {
        this.$store.dispatch("getUser");
        // this.$store.dispatch("getLocations");
    },
};
</script>
<style scoped>
h4 {
    text-align: center;
    margin-top: 20px;
}
.user-info {
    border: 1px solid black;
    max-width: 500px;
    text-align: center;
}
</style>
