<template>
    <div>
        <Navbar />
        <div class="title">
            <h4>S'inscrire comme producteur</h4>
        </div>
        <div class="connect">
            <div>
                <label for="name">Votre nom</label><br />
                <input type="text" name="name" v-model="formData.name" />
                <div v-if="errors && errors.name">
                    {{ errors.name[0] }}
                </div>
            </div>
            <div>
                <label for="business_name">Nom de votre entrprise</label><br />
                <input
                    type="text"
                    name="name"
                    v-model="formData.business_name"
                />
                <!-- <div v-if="errors && errors.name">
                    {{ errors.name[0] }}
                </div> -->
            </div>

            <div>
                <label for="email">Votre Email</label> <br />
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
            <!-- <div>
                <label for="adress">Votre Adresse</label> <br />
                <input type="text" name="adress" v-model="formData.adress" />
                <div v-if="errors && errors.email">
                    {{ errors.email[0] }}
                </div>
            </div> -->
            <!-- <div>
                <label for="phone">Votre Numéro de téléphone</label> <br />
                <input type="text" name="phone" v-model="formData.phone" />
                <div v-if="errors && errors.email">
                    {{ errors.email[0] }}
                </div>
            </div> -->
            <div>
                <label for="password">Votre mot de passe</label> <br />
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
                >
                <br />
                <input
                    type="password"
                    name="password_confirmation"
                    v-model="formData.password_confirmation"
                />
            </div>
            <div>
                <button class="btn-connect" @click.prevent="registerProducteur">
                    S'inscrire
                </button>
            </div>
        </div>
    </div>
    {{ formData }}
</template>

<script>
import Navbar from "../components/Navbar.vue";
export default {
    components: {
        Navbar,
    },
    data() {
        return {
            formData: {
                name: "",
                business_name: "",
                email: "",
                location_id: "",
                password: "",
                password_confirmation: "",
            },
            errors: {},
        };
    },

    methods: {
        registerProducteur() {
            // console.log(this.formData);
            axios
                .post("api/registerProducteur", this.formData)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
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
