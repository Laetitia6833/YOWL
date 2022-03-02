<template>
    <!-- <div class="search__container"> -->
    <div class="search">
        <div class="search-text">
            <h4>Que chercher-vous ?</h4>
        </div>
        <div class="search_bar">
            <input
                placeholder="Fraise..."
                type="text"
                v-model="searchWord"
                class="input-text"
            />
        </div>
        <div class="select">
            <select name="location" id="location" v-model="locationSearch">
                <option value="">All</option>
                <option
                    v-for="location in locations"
                    :key="location.id"
                    :value="location.id"
                >
                    <span>{{ location.location_code }}</span>
                    - {{ location.location_nom }}
                </option>
            </select>
        </div>
        <button @click="search" class="input-rechercher">Rechercher</button>
    </div>
    <!-- </div> -->
</template>
<script>
import _ from "lodash";
export default {
    name: "Searchbar",

    data() {
        return {
            searchWord: "",
            locationSearch: "",
            prod: "",
        };
    },

    methods: {
        search() {
            localStorage.removeItem("searchResult");
            let producteurs = this.$store.state.producteurs;
            let products = this.$store.state.products;
            let arr = [];
            if (this.searchWord) {
                products = products.filter(
                    (product) =>
                        product.name
                            .toLowerCase()
                            .includes(this.searchWord.toLowerCase())
                    // producteurs.filter((prod) => prod.id === pr);
                );
                products.forEach((product) => {
                    arr.push(
                        this.$store.getters.producteur(product.producteur_id)
                    );
                });

                if (this.locationSearch) {
                    arr = arr.filter(
                        (producteur) =>
                            producteur.location_id === this.locationSearch
                    );
                }
                this.prod = arr;
                localStorage.setItem("searchResult", JSON.stringify(this.prod));
                // this.$router.push({ name: "ResultResearch" });
                window.location = "/result";

                return;
            }
            // producteurs = arr;

            if (this.locationSearch) {
                producteurs = producteurs.filter(
                    (producteur) =>
                        producteur.location_id == this.locationSearch
                );
                this.prod = producteurs;
                localStorage.setItem("searchResult", JSON.stringify(this.prod));
                // this.$router.push({ name: "ResultResearch" });
                window.location = "/result";

                return;
            }

            this.prod = producteurs;
            localStorage.setItem("searchResult", JSON.stringify(this.prod));
            // this.$router.push({ name: "ResultResearch" });
            window.location = "/result";
            this.$emit("prod", this.prod);
            return;
        },
    },

    computed: {
        locations() {
            return this.$store.state.locations;
        },
    },
};
</script>
<style lang="scss">
.search__container {
    height: 90vh;
    display: grid;
    place-items: center;
}
.search {
    /* display: flex; */
    /* justify-content: center; */
    width: 80%;
    max-width: 500px;
    margin: auto;

    button {
        width: 100%;
        color: white;

        padding: 5px;
        height: 35px;
        cursor: pointer;
        transition: all 0.3s;

        &:hover {
            background: white;
            color: #ff8f0d;
            border: 2px solid #ff8f0d;
        }
    }
}

.search_bar {
    width: 100%;
}

.search_bar input {
    width: 100%;
    padding: 5px;
    border-bottom: 1px solid black;
    height: 35px;
}
.select {
    width: 100%;
}
.select select {
    display: block;
    width: 100%;
    padding: 5px;
    height: 35px;
    border: none;
}
.search-text {
    display: flex;
    justify-content: center;
    padding-bottom: 5px;
    color: green;
    margin-top: 10px;
    font-weight: bolder;
    margin-bottom: 20px;
}
.input-rechercher {
    background: #ff8f0d;
    border: #ff8f0d;
    padding: 5px;
}
.input-text {
    width: 250px;
    border: none;
}
</style>
