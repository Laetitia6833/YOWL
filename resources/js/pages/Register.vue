<template>
    <div>
        <Navbar />
        <div class="title">
            <h4>Vous êtes ?</h4>
        </div>
        <div class="register">
            <div class="user">
                <div>
                    <router-link
                        :to="{ name: 'UserRegister' }"
                        style="text-decoration: none; color: inherit"
                        >Utilisateur</router-link
                    >
                </div>
            </div>
            <div class="pro">
                <router-link
                    :to="{ name: 'ProducteurRegister' }"
                    style="text-decoration: none; color: inherit"
                    >Producteur</router-link
                >
            </div>
        </div>

        <router-view></router-view>
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
.register {
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
