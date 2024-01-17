<template>
    <div>
        <h2>Lista de Categorias</h2>
        <button @click="newCategory()">Nueva categoria</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in Categorys" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.descripcion }}</td>
                    <td>
                        <button @click="editCategory(category.id)">Editar</button>
                        <button @click="deleteCategory(category.id)">Eliminar</button>
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
            Categorys: []
        };
    },
    mounted() {
        this.fetchCategorys();
    },
    methods: {
        fetchCategorys() {
            axios.get('http://127.0.0.1:8000/api/categoria')
                .then(response => {
                    this.Categorys = response.data;
                });
        },
        newCategory() {
            this.$router.push({ name: 'categoria-nuevo' });
        },
        editCategory(CategoryId) {
            this.$router.push({ name: 'categoria-editar', params: { id: CategoryId } });
        },
        deleteCategory(CategoryId) {
            const confirmDelete = window.confirm('¿Estás seguro de que quieres eliminar este categoria?');
            if (confirmDelete) {
                axios.delete(`http://127.0.0.1:8000/api/categoria/${CategoryId}`)
                    .then(response => {
                        this.fetchCategorys();
                    });
            }
        }
    }
};
</script>