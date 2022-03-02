<template>
    <Navbar />
    <div id="profil">
        <transition name="slide">
            <div class="alert alert-success" v-if="success">
                {{ this.success }}
            </div>
        </transition>

        <transition name="slide">
            <div class="alert alert-danger" v-if="danger">
                {{ this.danger }}
            </div>
        </transition>

        <!-- HEADER -->
        <header class="header">
            <h2>{{ user.business_name }}</h2>

            <div class="header__item">
                <div v-if="this.user.description">
                    <p>
                        {{ this.user.description }}
                    </p>
                </div>
                <p v-else>Renseigner votre description</p>
            </div>
            <div class="header__item">
                <p v-if="this.user.adress">{{ this.user.adress }}</p>
                <p v-else>Renseigner votre adresse</p>
                <p>
                    <span>{{ departement.location_code }}</span>
                    - {{ departement.location_nom }}
                </p>
            </div>
            <div class="header__item">
                <span>Mon numero de téléphone : </span>
                <p class="phone" v-if="this.user.phone">
                    {{ this.user.phone }}
                </p>
                <p class="phone" v-else>Renseigner votre adresse</p>
            </div>
            <div class="form__controller">
                <router-link
                    class="btn btn__submit"
                    :to="{ name: 'UpdateProfil', params: { id: user.id } }"
                >
                    Modifier mon profil
                </router-link>
            </div>
        </header>

        <!-- PANIERS -->
        <section>
            <h3>Mes paniers</h3>

            <div class="card__container">
                <basket-card
                    v-for="basket in baskets"
                    :key="basket.id"
                    :basket="basket"
                    @danger="getMessageDanger"
                />
            </div>

            <!-- MODAL PANIER -->
            <div class="btn btn__submit" @click="openModalBasket">
                Ajouter un pannier
            </div>
            <div>
                <div v-show="isModalBasketVisible" class="modal-box">
                    <transition name="fade">
                        <background-modal
                            v-show="isModalBasketVisible"
                            @closeBasket="closeModalBasket"
                        />
                    </transition>
                    <transition name="bounce">
                        <modal-basket
                            v-show="isModalBasketVisible"
                            @closeBasket="closeModalBasket"
                            @success="getMessage"
                        />
                    </transition>
                </div>
            </div>
        </section>

        <!-- PRODUCTS -->
        <section>
            <h3>Mes produits</h3>

            <div class="card__container">
                <product-card
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                    @danger="getMessageDanger"
                />
            </div>

            <div class="btn btn__submit" @click="openModal">
                Ajouter un produit
            </div>
            <div>
                <div v-show="isModalVisible" class="modal-box">
                    <transition name="fade">
                        <background-modal
                            v-show="isModalVisible"
                            @close="closeModal"
                        />
                    </transition>
                    <transition name="bounce">
                        <modal-product
                            v-show="isModalVisible"
                            @close="closeModal"
                            @success="getMessage"
                        />
                    </transition>
                </div>
            </div>
        </section>

        <pre></pre>
        <!-- <Footer /> -->
    </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import modalProduct from "../components/Modal/ModalProduct.vue";
import modalBasket from "../components/Modal/ModalBasket.vue";
import backgroundModal from "../components/Modal/ModalBackground.vue";
import ProductCard from "../components/producteur/ProductCard.vue";
import BasketCard from "../components/producteur/BasketCard.vue";

// import Footer from "../components/Footer.vue";
import { mapGetters } from "vuex";
import axios from "axios";

export default {
    data() {
        return {
            // product: {
            //     name: "",
            // },
            errors: {},
            isModalVisible: false,
            success: "",
            danger: "",
            isModalBasketVisible: false,
            // user: this.$store.state.user,
            // user: {},
        };
    },

    components: {
        Navbar,
        // Footer,
        modalProduct,
        modalBasket,
        backgroundModal,
        ProductCard,
        BasketCard,
    },

    methods: {
        openModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
            this.$store.dispatch("getProducts");
        },
        closeModalBasket() {
            this.$store.dispatch("getBaskets");
            this.isModalBasketVisible = false;
        },
        openModalBasket() {
            this.isModalBasketVisible = true;
        },
        getMessage(value) {
            this.success = value;
            setTimeout(() => {
                this.success = "";
            }, 3000);
        },
        getMessageDanger(value) {
            this.danger = value;
            setTimeout(() => {
                this.danger = "";
            }, 3000);
        },
    },

    computed: {
        categories() {
            return this.$store.state.categories;
        },
        products() {
            return this.$store.getters.productsFromProducteur(
                this.$store.state.user.id
            );
        },

        baskets() {
            return this.$store.getters.basketsFromProducteur(
                this.$store.state.user.id
            );
        },

        ...mapGetters({
            departement: "departement",
            user: "currentUser",
        }),
    },

    mounted() {
        //     // this.$store.dispatch("getLocations");
        // this.$store.dispatch("getCategories");
        this.$store.dispatch("getProducts");
        this.$store.dispatch("getBaskets");
        //     this.d = this.$store.getters.departement;
    },
};
</script>

<style lang="scss">
#profil {
    padding-top: 100px;
}
.header {
    max-width: 80%;
    margin: 20px auto;

    &__item {
        margin: 10px 0;
    }

    .form__controller {
        margin-top: 50px;

        .btn__submit {
            display: block;
            width: max-content;
        }
    }

    h2 {
        font-size: 40px;
        margin-bottom: 20px;
    }

    .phone {
        display: inline-block;
    }
}

section {
    h3 {
        font-size: 30px;
        text-align: center;
        margin-bottom: 20px;
    }

    .btn__submit {
        width: max-content;
        margin: 50px auto;
    }
}

.alert {
    position: fixed;
    top: 20px;
    transform: translateX(-50%);
    text-align: center;
    padding: 20px;
    width: 80%;
    left: 50%;
    border-radius: 5px;
    z-index: 500;

    &-success {
        background: rgba(112, 233, 112, 0.849);
        color: rgb(0, 99, 0);
        border: 1px solid rgb(0, 99, 0);
    }
    &-danger {
        background: rgba(233, 112, 112, 0.849);
        color: rgb(99, 12, 0);
        border: 1px solid rgb(99, 12, 0);
    }
}

.card__container {
    max-width: 80%;
    margin: auto;

    @media (min-width: 540px) {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-around;
    }
    @media (max-width: 790px) {
        justify-content: center;
    }
}
.modal-box {
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(197, 197, 197, 0.281);
    display: grid;
    place-items: center;
    overflow-y: scroll;
    z-index: 100;
}
/* TRANSITION */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.7s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
// SLIDE \\
.slide-enter-active,
.slide-leave-active {
    transition: all 0.7s ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translate(-50%, -100px);
    opacity: 0;
}
// ANIMATION TRANISITION
.bounce-enter-active {
    animation: bounce-in 0.7s;
}
.bounce-leave-active {
    animation: bounce-out 0.7s;
}
@keyframes bounce-in {
    0% {
        opacity: 0;
        transform: scale(0);
    }
    50% {
        opacity: 1;
        transform: scale(1.3);
    }

    100% {
        transform: scale(1);
    }
}
@keyframes bounce-out {
    0% {
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.3);
    }
    100% {
        opacity: 0;
        transform: scale(0);
    }
}
</style>
