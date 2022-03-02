<template>
    <nav class="navbar">
        <div class="navbar__links">
            <router-link class="link link--primary" to="/">Logo</router-link>
        </div>
        <div class="navbar__links" v-if="auth === ''">
            <router-link class="link link--primary" :to="{ name: 'Register' }"
                >S'inscrire</router-link
            >
            <router-link class="link" :to="{ name: 'Login' }"
                >Se connecter</router-link
            >
        </div>
        <div class="navbar__links" v-if="auth">
            <router-link
                class="link link--primary"
                :to="{
                    name: auth === 'user' ? 'User' : `Producteur`,
                    params: { id: this.$store.state.user.id },
                }"
            >
                Profil
            </router-link>
            <div class="link link--logout" @click="logout">Logout</div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Navbar",

    data() {
        return {
            auth: this.$store.state.authenticated,
        };
    },

    methods: {
        async logout() {
            await axios
                .get("api/logout", {})
                .then((response) => {
                    localStorage.removeItem("token");
                    localStorage.removeItem("user");
                    localStorage.removeItem("auth");
                    this.auth = "";
                    (this.$store.state.user = "")(
                        (this.$store.state.authenticated = "")
                    );
                    this.$router.push("/");
                })
                .catch((errors) => {
                    console.log(errors);
                });
            this.$router.push("/");
        },
    },
};
</script>

<style lang="scss">
.navbar {
    display: flex;
    justify-content: space-between;
    padding-right: 20px;
    padding-left: 20px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;

    &__links {
        display: flex;
        align-items: center;
        height: 50px;

        .link {
            height: 100%;
            //   background: green;
            align-items: center;
            display: flex;
            padding: 0 15px;
            cursor: pointer;

            &--primary {
                background: #ff8f0d;
                color: white;
            }
        }
    }
}
</style>
