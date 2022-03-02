<template>
    <div class="modal modal__basket">
        <div @click="closeModal" class="btn__close">X</div>
        <div class="modal__title">
            <h2>Ajouter un pannier</h2>
        </div>
        <form
            action="#"
            @submit.prevent="addBasket"
            enctype="multipart/form-data"
        >
            <div class="form__controller">
                <label class="form__label" for="name">Nom du Pannier</label>
                <input class="form__item" type="text" v-model="basket.name" />
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">
                    Description du Pannier
                </label>
                <textarea
                    class="form__item textarea"
                    v-model="basket.content"
                    type="text"
                ></textarea>
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">Prix</label>
                <input
                    class="form__item"
                    type="number"
                    step="0.01"
                    v-model="basket.price"
                />
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">Quantité</label>
                <input
                    class="form__item"
                    type="number"
                    v-model="basket.quantity"
                />
            </div>
            <div class="form__controller">
                <input
                    name="image"
                    type="file"
                    ref="file"
                    @change="handleFileObject"
                />
            </div>

            <!-- <div v-if="errors.name" v-text="errors"></div> -->
            <div class="form__controller">
                <button class="btn btn__submit">Ajouter</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
// import _ from "lodash";
export default {
    name: "modalBasket",

    data() {
        return {
            basket: {
                name: "",
                content: "",
                producteur_id: this.$store.state.user.id,
                price: "",
                quantity: "",
                imageName: "",
                image: "",
            },
            image: null,
            imageName: null,
        };
    },

    methods: {
        async addBasket() {
            const config = {
                headers: {
                    "Content-Type":
                        "multipart/form-data;boundary=---------------------------974767299852498929531610575",
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                    methods: "POST",
                    "Access-Control-Allow-Origin": "*",
                    "X-CSRF-TOKEN": document
                        .getElementById("token")
                        .getAttribute("value"),
                    "XSRF-TOKEN":
                        "eyJpdiI6Ik9jTHR6cm5GZ0U3VlBnOXRVSzMrQkE9PSIsInZhbHVlIjoiUVQ3TUt3MnlqS2FsQlBQTUUrQXROazlVYlI1aW9IeG95TkJEVVpyTXJnVXZtS09mWXlBTVFCZEVITzZ2R2FvWDZRcysrcFUwSnV5ZWFnNlhmc1NkS3oyTlNWWlAzNVRiNWxSTk0xSlpoRlNNT2E2Sk5MeFhZY3B3dlBSNmJwZUMiLCJtYWMiOiIwNDIzMTA1MTk4YjYwZTM3YWZiOTdjNjMyOTQ2Y2VlMWFkOGU3YjczZWIwYWRmN2YwNjQ1OTk2NTU3NWQ2MzhkIiwidGFnIjoiIn0%3D",
                    "Access-Control-Allow-Methods":
                        "GET, POST, OPTIONS, PUT, DELETE",
                },
            };

            let self = this;
            let formData = new FormData();
            formData.append("file", this.image);
            formData.append("name", this.basket.name);
            formData.append("producteur_id", this.basket.producteur_id);
            formData.append("content", this.basket.content);
            formData.append("price", this.basket.price);
            formData.append("quantity", this.basket.quantity);
            formData.append("image", this.image);

            try {
                let response = await axios.post(
                    "/api/addBasket",
                    formData,
                    config
                );
                if (response.status === 200) {
                    this.basket.name = "";
                    this.basket.content = "";
                    this.basket.quantity = "";
                    this.basket.price = "";
                    this.basket.imageName = "";
                    this.basket.image = "";
                }
                this.closeModal();
                this.$emit("success", "Pannier ajouté avec succès");
            } catch (error) {
                console.log(error.response);
                this.errors = error.response.data.errors;
            }
        },

        handleFileObject(e) {
            this.image = this.$refs.file.files[0];
            console.log(this.$refs.file.files[0]);
            this.imageName =
                new Date().getTime().toString() + "-" + this.imageName;
        },

        closeModal() {
            this.$emit("closeBasket");
        },
    },
};
</script>

<style lang="scss">
// .bg {
//     position: fixed;
//     top: 0;
//     bottom: 0%;
//     left: 0;
//     right: 0;
//     overflow: scroll;
// }
.btn__close {
    position: absolute;
    right: 0;
    background: rgb(228, 10, 10);
    width: 30px;
    height: 30px;
    display: grid;
    place-items: center;
    color: white;
    transform: translate(50%, -50%);
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s;

    &:hover {
        transform: translate(50%, -50%) scale(1.2);
    }
}
.modal {
    position: relative;
    max-width: 500px;
    width: 80%;
    background: white;
    margin-top: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    z-index: 100;

    &__title {
        text-align: center;
        margin: 30px 0;
        font-size: 25px;
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
}
</style>
