<template>
    <div>
        <Navbar />
        <div class="title">
            <h4>Connexion à votre espace producteur</h4>
        </div>
        <div class="connect">
            <div>
                <label for="email">Votre email</label><br />
                <input type="text" name="email" v-model="formData.email" />
                <div v-if="errors" v-text="errors.email"></div>
            </div>
            <div>
                <label for="password">Votre mot de passe</label> <br />
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
            // axios.get("/sanctum/csrf-cookie").then((res) => {
            //   console.log(res);
            //   axios
            //     .post("api/loginProducteur", this.formData)
            //     .then((response) => console.log(response));
            // });'

            try {
                let response = await axios.post(
                    "api/loginProducteur",
                    this.formData
                );
                // await axios.get("/sancum/csrf-cookie");
                let user = await axios.get("api/user", {
                    headers: {
                        Authorization: `Bearer ${response.data}`,
                    },
                });
                user.data.type = "producteur";
                user.data.token = response.data;
                this.$store.commit("setAuthentication", "producteur");
                this.$store.commit("setUser", user.data);
                localStorage.setItem("token", response.data);
                // console.log(user);

                this.$router.push(`/producteur/${user.data.id}`);
            } catch (error) {
                console.log(error);
                this.errors = error.response.data.errors;
            }
        },
    },
};
</script>

<style>
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
