<template>
    <div class="home">
        <Navbar />
        <!-- <div class="search__container"> -->
        <!-- <Searchbar /> -->
        <!-- </div> -->

        <div class="mt">
            <router-link class="link_back" :to="{ path: '/result' }"
                ><span>&#x2190;</span> Retour à la recherche</router-link
            >
            <div class="name">
                {{ producteur.business_name }}
            </div>

            <div class="content">
                <div class="tc-image">
                    <img
                        src="https://images.pexels.com/photos/235725/pexels-photo-235725.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                        class="image"
                    />
                </div>
                <div class="description">
                    {{ producteur.description }}
                </div>
            </div>
            <div class="contact">
                <div class="h4">
                    <h4>Contactez-nous ou venez directement nous voir :</h4>
                </div>
                <div class="pro">
                    {{ producteur.email }} <br />
                    {{ producteur.adress }} <br />
                    {{ producteur.phone }} <br />
                    {{ producteur.link }}
                </div>
            </div>

            <!-- <pre>
            producteur: 
            {{ producteur }}
        </pre> -->
            <div class="name">Nos produits</div>
            <div class="produits" v-for="product in products" :key="product.id">
                <div class="tc-product-card">
                    <div class="productName">
                        {{ product.name }}
                    </div>
                    <div class="flex">
                        <div class="productDescription">
                            {{ product.description }}
                        </div>
                        <div class="productImage">
                            <img :src="product.image_path" class="image" />
                        </div>
                    </div>
                    <div class="productPrice">{{ product.price }} euros/kg</div>
                    <hr />
                </div>
            </div>

            <div class="name">Nos paniers</div>
            <div class="produits" v-for="basket in baskets" :key="basket.id">
                <div class="tc-product-card">
                    <div class="productName">
                        {{ basket.name }}
                    </div>
                    <div class="flex">
                        <div class="productDescription">
                            {{ basket.content }}
                        </div>
                        <div class="productImage">
                            <img :src="basket.image_path" class="image" />
                        </div>
                    </div>
                    <div class="productQuantity">
                        {{ basket.quantity }} paniers
                    </div>
                    <div class="productPrice">{{ basket.price }} euros/kg</div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Searchbar from "../components/Searchbar.vue";
export default {
    components: {
        Navbar,
        Searchbar,
    },

    // props: ["producteur"],

    computed: {
        // producteurs() {
        //     return this.$store.state.producteurs;
        // },
        producteur() {
            return this.$store.getters.producteur(this.$route.params.id);
        },
        products() {
            return this.$store.getters.productsFromProducteur(
                this.$route.params.id
            );
        },
        baskets() {
            return this.$store.getters.basketsFromProducteur(
                this.$route.params.id
            );
        },
    },
};
</script>
<style scoped>
.link_back {
    margin-left: 30px;
    display: block;
    width: max-content;
    transition: all 0.3s ease;
}
.link_back:hover {
    transform: translateX(-10px);
}
.name {
    padding: 15px;
    font-size: 25px;
    font-weight: bolder;
    color: green;
    text-align: center;
    margin-top: 10px;
}
.content {
    text-align: center;

    margin-left: 50px;
    margin-right: 50px;
    max-width: 1200px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    background: cornsilk;
    opacity: 0.8;
    border-radius: 20px;
}
.image {
    max-width: 200px;
    margin-left: 10px;
    margin-right: 10px;
    border-radius: 20px;
}
.tc-image {
    text-align: end;
}
.contact {
    display: flex;
    justify-content: center;

    padding: 10px;

    margin-top: 20px;
}
.h4 {
    max-width: 150px;
    text-align: center;
    margin-right: 10px;
    color: white;
    background: green;
    padding: 10px;
}
.pro {
    padding: 10px;
    border: green 1px solid;
}
.tc-product-card {
    margin: 10px;
    padding: 5px;
    /* border: orange solid 3px; */
    border-radius: 10px;
    width: 400px;
    height: 300px;
    margin: 20px;
    padding: 5px;
    text-align: center;
    border-radius: 15px;
    transition: 0.3s;

    flex-wrap: wrap;
}
.productName {
    text-align: center;
    font-weight: bolder;
}
.productImage {
    width: 200px;
    height: 200px;
}
.image {
    object-fit: cover;
    width: 100%;
    height: 100%;
}
.produits {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.productPrice {
    display: flex;
    justify-content: end;
}
.flex {
    display: flex;
    justify-content: space-around;
    padding: 10px;
}
hr {
    background: green;
    padding: 1px;
    border-radius: 15px;
}
.productQuantity {
    display: flex;
    justify-content: left;
}
</style>
