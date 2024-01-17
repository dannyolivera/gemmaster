<template>
    <div>
        <h2>Nueva Categoria</h2>
        <form @submit.prevent="saveChanges">            
            <label for="name">Nombre:</label>
            <input v-model="categoryNombre" type="text" id="name" name="name" />
            <br />

            <label for="description">Descripción:</label>
            <input v-model="categoryDescripcion" type="text" id="description" name="description" />
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
            categoryNombre: '',
            categoryDescripcion: '',
        };
    },
    methods: {
        saveChanges() {
            axios.put(`http://127.0.0.1:8000/categoria`, {
                nombre: this.categoryNombre,
                descripcion: this.categoryDescripcion,
            })
                .then(response => {
                    console.log('Cambios guardados con éxito:', response.data);
                });
        },
    },
};
</script>
