<template>
    <div class="mt">
        <Navbar />
        <h1 class="title">Mettre à jour le profil</h1>

        <form>
            <div v-if="this.errors" class="errors">
                <p v-for="error in this.errors" :key="error">
                    {{ error[0] }}
                </p>
            </div>
            <div class="form__controller">
                <label class="form__label" for="name"
                    >Nom de l'entreprise
                </label>
                <input
                    class="form__item"
                    type="text"
                    v-model="user.business_name"
                />
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">Votre nom </label>
                <input class="form__item" type="text" v-model="user.name" />
            </div>
            <div class="form__controller">
                <label class="form__label" for="email">Votre Email </label>
                <input class="form__item" type="text" v-model="user.email" />
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">
                    description de l'entrprise
                </label>
                <textarea
                    class="form__item textarea"
                    v-model="user.description"
                    type="text"
                ></textarea>
            </div>
            <div class="form__controller">
                <label class="form__label" for="phone">
                    Votre Numéro de téléphone
                </label>
                <input class="form__item" type="text" v-model="user.phone" />
            </div>

            <div class="form__controller">
                <label class="form__label" for="email">Adresse</label>
                <input class="form__item" type="text" v-model="user.adress" />
            </div>
            <div class="form__controller">
                <label class="form__label" for="email"
                    >Etes vous producteur bio?</label
                >
                <input class="form__item" type="checkbox" v-model="user.bio" />
            </div>

            <div class="form__controller">
                <select
                    class="form__item"
                    name="location_id"
                    id="category"
                    v-model="user.location_id"
                >
                    <option
                        v-for="location in locations"
                        :key="location.id"
                        :value="location.id"
                    >
                        {{ location.location_code }} -
                        {{ location.location_nom }}
                    </option>
                </select>
            </div>

            <!-- <div v-if="errors.name" v-text="errors"></div> -->
            <div class="form__controller">
                <button @click.prevent="updateProfil" class="btn btn__submit">
                    Modifier les informations
                </button>
            </div>
        </form>
    </div>
</template>


<script>
import Navbar from "../../components/Navbar.vue";
import axios from "axios";

export default {
    components: { Navbar },

    data() {
        return {
            errors: "",
        };
    },

    computed: {
        user() {
            return this.$store.state.user;
        },
        locations() {
            return this.$store.getters.allLocations;
        },
    },

    methods: {
        updateProfil() {
            axios
                .put(`/api/update/${this.user.id}`, this.user, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    // localStorage.setItem("user", JSON.stringify(response.data));
                    if (response.status === 200) {
                        let user = response.data;
                        user.token = localStorage.getItem("token");
                        this.$store.commit("setUser", user);
                        this.$emit("success", "Profil modifié avec succès");
                        this.$router.push({
                            path: `/producteur/${user.id}`,
                            query: { sucess: "Profil modifié avec succès" },
                        });
                        // this.$router.go(-1);
                    }
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>


<style lang="scss">
.errors {
    text-align: center;
    color: red;

    p {
        margin: 5px;
    }
}
.title {
    text-align: center;
    font-size: 30px;
    margin-bottom: 20px;
}
.form__controller {
    width: 80%;
    margin: 0 auto 30px auto;
}

.form__item {
    width: 100%;
    display: block;
    height: 40px;
    text-transform: capitalize;
    padding: 5px;
    letter-spacing: 1px;
    font-size: 18px;

    &.textarea {
        height: 100px;
        font-size: 16px;
        resize: none;
    }
}

.form__label {
    display: block;
    margin: auto;
    margin-bottom: 10px;
}

label {
    display: block;
}

.btn__submit {
    margin: 0 auto 20px auto;
    width: 100%;
    padding: 12px;
    border: 2px solid transparent;
    background: #ff8f0d;
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s;

    &:hover {
        border: 2px solid #ff8f0d;
        color: #ff8f0d;
        background: rgb(255, 255, 255);
    }
}
</style>
