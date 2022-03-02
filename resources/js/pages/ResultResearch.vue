<template>
    <div>
        <div class="home">
            <Navbar />
            <div class="shearch__container">
                <Searchbar />
            </div>
            <div class="display__results">
                <div v-if="numberProducteur > 0">
                    <p>
                        Il y a
                        <span>{{ numberProducteur }}</span>
                        producteur{{ numberProducteur > 1 ? "s" : "" }} qui
                        possèd{{ numberProducteur === 1 ? "e" : "ent" }}
                        ce que vous recherchez
                    </p>
                </div>
                <div v-else>
                    <p>Désolé nous n'avons rien trouvé pour votre recherche</p>
                </div>
            </div>
            <div class="tc-wrapper">
                <div class="tc-pro">
                    <div class="tc-pro-name">
                        <div
                            v-for="producteur in producteurs"
                            :key="producteur.id"
                        >
                            <router-link
                                :to="{
                                    name: 'InfoProducteur',
                                    params: { id: producteur.id },
                                }"
                                :producteur="producteur"
                            >
                                <div class="tc-pro-card">
                                    <div class="tc-name">
                                        {{ producteur.business_name }}
                                        <hr />
                                    </div>
                                    <div class="content">
                                        <div class="tc-description">
                                            <div class="description">
                                                {{ producteur.description }}
                                                <br />
                                            </div>
                                        </div>
                                        <br />

                                        <div class="note">
                                            Note des utilisateurs:
                                            {{ producteur.note }}
                                        </div>
                                        <div class="tc-image">
                                            <img
                                                src="https://images.pexels.com/photos/235725/pexels-photo-235725.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                class="image"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                    <!-- <producteur></producteur> -->
                </div>
            </div>
        </div>
    </div>
    {{ prod }}
</template>
<script>
import Navbar from "../components/Navbar.vue";
import Searchbar from "../components/Searchbar.vue";

// import axios from "axios";
export default {
    // name: 'searchResult',

    components: {
        Navbar,
        Searchbar,
    },

    data() {
        return {
            prod: "",
        };
    },

    computed: {
        producteurs() {
            return JSON.parse(localStorage.getItem("searchResult"));
        },
        numberProducteur() {
            console.log(this.producteurs.length);
            return this.producteurs.length;
        },
    },
    mounted() {
        this.$store.dispatch("getProducteurs");
    },
};
</script>
<style scoped>
.home {
    background: center / cover
        url("https://images.pexels.com/photos/207247/pexels-photo-207247.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
}
.shearch__container {
    padding-top: 100px;
}

.display__results {
    padding: 20px;
    background: rgba(255, 255, 255, 0.753);
    border-radius: 10px;
    margin-bottom: 30px;
    width: max-content;
    margin: 30px auto 0 auto;
}
.display__results span {
    font-weight: bold;
}
.tc-wrapper {
    width: auto;
    padding: 30px;
    margin-top: 30px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}
.tc-pro {
    max-width: 800px;
    display: flex;
    gap: 10px;

    padding: 10px;
}
.tc-name {
    text-align: center;
}
.tc-pro-card {
    background: rgb(229, 255, 214);
    margin: 10px;
    padding: 5px;
    border: orange solid 3px;
    border-radius: 10px;
}
hr {
    background: green;
    padding: 1px;
    border-radius: 15px;
    margin: 10px;
}
.image {
    max-width: 200px;
    margin-left: 10px;
    margin-right: 10px;
}
.content {
    display: flex;
    justify-content: center;
}
.tc-name {
    font-size: 20px;
    font-weight: bolder;
}
.tc-description {
    margin-right: 10px;
}

.note {
    display: flex;
    justify-content: center;
}
.description {
    text-align: justify;
}
</style>
