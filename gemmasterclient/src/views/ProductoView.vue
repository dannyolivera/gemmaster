<template>
    <div>
        <h2>Lista de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.nombre }}</td>
                    <td>{{ product.precio }}</td>
                    <td>{{ product.stock }}</td>
                    <td>{{ product.id_categoria }}</td>
                    <td>
                        <button @click="editProduct(product.id)">Editar</button>
                        <button @click="deleteProduct(product.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: []
        };
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios.get('http://127.0.0.1:8000/api/producto')
                .then(response => {
                    this.products = response.data;
                });
        },
        editProduct(productId) {
            this.$router.push({ name: 'producto-editar', params: { id: productId } });
        },
        deleteProduct(productId) {
            const confirmDelete = window.confirm('¿Estás seguro de que quieres eliminar este producto?');
            if (confirmDelete) {
                axios.delete(`http://127.0.0.1:8000/api/producto/${productId}`)
                    .then(response => {
                        this.fetchProducts();
                    });
            }
        }
    }
};
</script>