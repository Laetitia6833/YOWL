<template>
    <div class="card product__card">
        <div @click="deleteProduct" class="btn__delete">
            <i class="fas fa-trash"></i>
        </div>
        <div class="product__card__image">
            <img :src="product.image_path" alt="" />
        </div>
        <div class="product__card__content">
            <div class="card__title">
                <h4>{{ product.name }}</h4>
            </div>
            <div class="content">
                <p class="description">{{ product.description }}</p>
                <p class="price" v-if="product.price !== null">
                    {{ product.price }}&euro;/kg
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "ProductCard",

    props: ["product"],

    methods: {
        deleteProduct() {
            axios
                .delete(`/api/deleteProduct/${this.product.id}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    console.log(response);
                    this.$store.dispatch("getProducts");
                    this.$emit("danger", "Produit supprimé");
                })
                .catch((error) => {
                    console.log(error);
                    console.log(error.response);
                });
        },
    },
};
</script>


<style lang="scss">
.btn__delete {
    position: absolute;
    right: 0;
    top: 0;
    width: 30px;
    height: 30px;
    display: grid;
    place-items: center;
    transform: translate(50%, -50%);
    border-radius: 9999px;
    background: rgb(241, 81, 81);
    cursor: pointer;
    transition: all 0.3s;

    .fa-trash {
        color: white;
    }

    &:hover {
        transform: scale(1.2) translate(50%, -50%);
    }
}

.product__card {
    position: relative;
    background: white;
    width: 100%;
    margin-bottom: 20px;
    box-shadow: 0px 0px 11px -7px #000000;

    @media (min-width: 540px) {
        width: 300px;
    }

    &__image {
        height: 150px;
        width: 100%;

        img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    }
    &__content {
        min-height: 150px;
        padding: 10px;

        .card__title {
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 70px;

            .description {
                font-size: 14px;
            }

            // .price {
            //     // float: right;
            //     // position: relative;
            //     // bottom: 0;
            //     // display: block;
            //     // margin-top: 30px;
            // }
        }
    }
}
</style>
