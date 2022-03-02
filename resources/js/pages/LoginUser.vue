<template>
    <div>
        <Navbar />
        <div class="title">
            <h4>Se connecter comme utilisateur</h4>
        </div>
        <div class="connect">
            <div>
                <label for="email">Votre email</label><br />
                <input type="text" name="email" v-model="formData.email" />
                <div v-if="errors" v-text="errors.email"></div>
            </div>
            <div>
                <label for="password">Votre mot de passe</label><br />
                <input
                    type="password"
                    name="password"
                    v-model="formData.password"
                />
                <!-- <div v-text="errors.password"></div> -->
            </div>
            <button class="btn-connect" @click.prevent="login">
                Se connecter
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Navbar from "../components/Navbar.vue";
export default {
    components: {
        Navbar,
    },
    data() {
        return {
            formData: {
                email: "",
                password: "",
                device_name: "browser",
            },
            errors: {},
        };
    },

    methods: {
        async login() {
            try {
                let response = await axios.post("api/login", this.formData);
                // await axios.get("/sancum/csrf-cookie");
                let user = await axios.get("api/user", {
                    headers: {
                        Authorization: `Bearer ${response.data}`,
                    },
                });
                user.data.type = "user";
                user.data.token = response.data;
                this.$store.commit("setAuthentication", "user");
                this.$store.commit("setUser", user.data);
                localStorage.setItem("token", response.data);
                this.$router.push(`/user/${user.data.id}`);
            } catch (error) {
                console.log(error);
                this.errors = error.response.data.errors;
            }
        },
    },
};
</script>
<style scoped>
.title {
    text-align: center;
}
.connect {
    text-align: center;
    padding: 20px;
    margin: 50px;
    background: orange;
}
.btn-connect {
    margin: 10px;
}
</style>
