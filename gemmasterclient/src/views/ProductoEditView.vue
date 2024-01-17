<template>
    <div>
        <h2>Editar Producto</h2>
        <form @submit.prevent="saveChanges">
            <label for="name">Nombre:</label>
            <input v-model="productNombre" type="text" id="name" name="name" />
            <br />

            <label for="price">Precio:</label>
            <input v-model="productPrecio" type="text" id="price" name="price" />
            <br />

            <label for="stock">Stock:</label>
            <input v-model="productStock" type="text" id="stock" name="stock" />
            <br />

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            productNombre: '',
            productPrecio: '',
            productStock: '',
        };
    },
    mounted() {
        this.loadProduct();
    },
    methods: {
        loadProduct() {
            axios.get(`http://127.0.0.1:8000/api/producto/${this.id}`)
                .then(response => {
                    const productData = response.data;
                    this.productNombre = productData.nombre;
                    this.productPrecio = productData.precio;
                    this.productStock = productData.stock;
                })
                .catch(error => {
                    console.error('Error al cargar datos del producto:', error);
                });
        },
        saveChanges() {
            axios.put(`http://127.0.0.1:8000/producto/${this.id}`, {
                nombre: this.productNombre,
                precio: this.productPrecio,
                stock: this.productStock,
                id_categoria: 3,
            })
                .then(response => {
                    // console.log('Cambios guardados con éxito:', response.data);
                });
        },
    },
};
</script>
