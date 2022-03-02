<template>
    <div>
        <Navbar />
        <div class="title">
            <h4>S'inscrire comme utilisateur</h4>
        </div>
        <!-- <form method="POST"> -->
        <div class="connect">
            <div>
                <label for="name">Votre nom</label><br />
                <input type="text" name="name" v-model="formData.name" />
                <div v-if="errors && errors.name">
                    {{ errors.name[0] }}
                </div>
            </div>
            <div>
                <label for="email">Votre Email</label><br />
                <input type="text" name="email" v-model="formData.email" />
                <div v-if="errors && errors.email">
                    {{ errors.email[0] }}
                </div>
            </div>
            <div>
                <label for="location">Votre département</label> <br />
                <select
                    name="location"
                    id="location"
                    v-model="formData.location_id"
                >
                    <option
                        v-for="location in locations"
                        :key="location.id"
                        :value="location.id"
                    >
                        <span>{{ location.location_code }}</span>
                        - {{ location.location_nom }}
                    </option>
                </select>
                <!-- <div v-if="errors && errors.email">
                    {{ errors.email[0] }}
                </div> -->
            </div>
            <div>
                <label for="password">Votre mot de passe</label><br />
                <input
                    type="password"
                    name="password"
                    v-model="formData.password"
                />
                <div v-if="errors && errors.password">
                    {{ errors.password[0] }}
                </div>
            </div>

            <div>
                <label for="password_confirmation"
                    >Confirmer votre mot de passe</label
                ><br />
                <input
                    type="password"
                    name="password_confirmation"
                    v-model="formData.password_confirmation"
                />
            </div>
            <div>
                <button class="btn-connect" @click.prevent="registerUser">
                    S'inscrire
                </button>
            </div>
        </div>

        <!-- </form> -->
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
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            errors: {},
        };
    },

    methods: {
        registerUser() {
            axios
                .post("api/register", this.formData)
                .then((res) => {
                    console.log(res.data);
                    this.errors = {};
                    this.$router.push("/");
                })
                .catch((errors) => {
                    if (errors.response.status == 422) {
                        this.errors = errors.response.data.errors;
                    }
                });
        },
    },
    computed: {
        locations() {
            return this.$store.getters.allLocations;
        },
    },

    mounted() {
        this.$store.dispatch("getLocations");
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
