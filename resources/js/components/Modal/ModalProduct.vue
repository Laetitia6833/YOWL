<template>
    <div class="modal">
        <div @click="closeModal" class="btn__close">X</div>
        <div class="modal__title">
            <h2>Ajouter un produit</h2>
        </div>
        <form
            action="#"
            @submit.prevent="addProduct"
            enctype="multipart/form-data"
        >
            <div class="form__controller">
                <select
                    class="form__item"
                    name="category"
                    id="category"
                    v-model="product.category_id"
                >
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">Nom du produit</label>
                <input class="form__item" type="text" v-model="product.name" />
            </div>
            <div class="form__controller">
                <label class="form__label" for="name"
                    >description du produit</label
                >
                <textarea
                    class="form__item textarea"
                    v-model="product.description"
                    type="text"
                ></textarea>
            </div>
            <div class="form__controller">
                <label class="form__label" for="name">Prix</label>
                <input
                    class="form__item"
                    type="number"
                    step="0.01"
                    v-model="product.price"
                />
            </div>
            <div class="form__controller">
                <input
                    name="file"
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
    name: "modalProduct",

    data() {
        return {
            product: {
                name: "",
                description: "",
                category_id: "",
                producteur_id: this.$store.state.user.id,
                price: "",
                imageName: "",
                image: "",
            },
            image: null,
            imageName: null,
        };
    },

    methods: {
        async addProduct() {
            //     axios.get("/sanctum/csrf-cookie").then((res) => {
            //         console.log(res);
            //     });
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

            // axios
            //     .post("/api/addProduct", formData, config)
            //     .then((response) => {
            //         console.log(response);
            //     })
            //     .catch((error) => {
            //         console.log(error.response);
            //     });
            let self = this;
            let formData = new FormData();
            // this.imageName = `${this.product.name}-${this.imageName}`;
            formData.append("file", this.image);
            formData.append("name", this.product.name);
            formData.append("category_id", this.product.category_id);
            formData.append("description", this.product.description);
            formData.append("price", this.product.price);
            formData.append("producteur_id", this.product.producteur_id);
            formData.append("image", this.image);

            // axios.defaults.headers.common[
            //     "Authorization"
            // ] = `Bearer ${localStorage.getItem("token")}`;
            // axios.defaults.headers.post["Content-Type"] = "multipart/form-data";
            try {
                let response = await axios.post(
                    "/api/addProduct",
                    formData,
                    config
                );
                if (response.status === 200) {
                    this.product.name = "";
                    this.product.description = "";
                    this.product.category_id = "";
                    this.product.price = "";
                    this.product.imageName = "";
                    this.product.image = "";
                }
                this.closeModal();
                this.$emit("success", "Produit ajouté avec succès");
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
            this.$emit("close");
        },
    },

    computed: {
        categories() {
            return this.$store.state.categories;
        },
    },

    mounted() {
        this.$store.dispatch("getCategories");
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
