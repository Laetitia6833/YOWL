<template>
    <div></div>
    <div>
        <div class="home">
            <Navbar />
            <div class="search__container">
                <Searchbar />
            </div>
            <!-- route vers tous les producteurs en attendant la recherche -->
            <div class="btn">
                <router-link to="/result">
                    <input
                        type="button"
                        value="Tous les producteurs"
                        class="btn-all"
                    />
                </router-link>
            </div>
            <div class="big-losange">
                <div class="info">
                    <p>
                        Réduire les émissions de CO2 en privilégiant le circuit
                        court
                    </p>
                    <p class="lien">En savoir plus</p>
                </div>
                <div class="info">
                    <p>Rencontrez les producteurs proche de chez vous</p>

                    <p class="lien">En savoir plus</p>
                </div>
                <div class="info">
                    <p>Consommez des produits frais, bios et de saison</p>

                    <p class="lien">En savoir plus</p>
                </div>
                <div class="info">
                    <p>
                        Découvrez les points de vent de vos producteurs favoris
                    </p>

                    <p class="lien">En savoir plus</p>
                </div>
            </div>
            <div class="last-div">
                <h4 class="title">Vous êtes producteurs ?</h4>
            </div>
            <p class="text-bottom">Elargissez votre clientèle !</p>
            <p class="text-bottom">Présentez vos produits</p>
        </div>
        <!-- {{ truc }} -->
        <!-- {{ products }} -->
        <!-- {{ categories }} -->
        <!-- <Footer /> -->
    </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Searchbar from "../components/Searchbar.vue";
import Footer from "../components/Footer.vue";
import axios from "axios";
// import Navbar from "../components/Navbar.vue";
// import axios from "axios";
export default {
    data() {
        return {};
    },

    components: {
        Navbar,
        Searchbar,
    },
};
</script>
<style scoped>
.home {
    background: center / cover
        url("https://images.pexels.com/photos/6412607/pexels-photo-6412607.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
}

.lien {
    color: orange;
}

.info {
    background: rgb(229, 255, 214);
    width: 80%;
    // max-width: 280px;
    height: 160px;
    margin: 20px;
    padding: 10px;
    text-align: center;
    border-radius: 15px;
    transition: 0.3s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    line-height: 1.5;
    letter-spacing: 1px;
}
.info:hover {
    transform: scale(1.1);
}
.last-div {
    display: flex;
    justify-content: center;
}
.title {
    background: orange;
    padding: 15px;
    margin-top: 30px;
    width: 300px;
    text-align: center;
}
.text-bottom {
    color: green;
    font-weight: bolder;
    text-align: center;
    padding: 10px;
    background: orange;
}
.big-losange {
    /* display: flex; */
    /* flex-wrap: wrap; */
    /* justify-content: center; */
    display: grid;
    place-items: center;
    max-width: 80%;
    margin: auto;
}
@media screen and (min-width: 680px) {
    .big-losange {
        grid-template-columns: repeat(2, 1fr);
    }
}
.lien {
    font-size: 14px;
    text-decoration: underline;
}
.btn {
    display: flex;
    justify-content: center;
    margin: 10px;
}
.btn-all {
    background: rgb(229, 255, 214);
    color: rgb(171, 112, 5);
    font-weight: bolder;
    border: none;
    border-radius: 10px;
    padding: 5px;
}
.btn-all:hover {
    background: orange;
    color: white;
}
</style>
