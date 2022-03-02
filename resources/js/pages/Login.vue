<template>
    <div>
        <Navbar />
        <div class="title">
            <h4>Vous êtes ?</h4>
        </div>
        <div class="login">
            <div class="user">
                <router-link
                    :to="{ name: 'LoginUser' }"
                    style="text-decoration: none; color: inherit"
                    >Utilisateur</router-link
                >
            </div>
            <div class="pro">
                <router-link
                    :to="{ name: 'LoginProducteur' }"
                    style="text-decoration: none; color: inherit"
                    >Producteur</router-link
                >
            </div>
        </div>
    </div>
</template>
<script>
import Navbar from "../components/Navbar.vue";
export default {
    components: {
        Navbar,
    },
};
</script>

<style scoped>
.login {
    display: flex;
    justify-content: space-around;
}
h4 {
    text-align: center;
}
.pro,
.user {
    background: orange;
    margin-top: 50px;
    padding: 30px;
    border-radius: 30px;
}
.title {
    padding: 20px;
}
</style>
