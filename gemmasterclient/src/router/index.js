import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CategoriaView from '../views/CategoriaView.vue'
import CategoriaEditView from '../views/CategoriaEditView.vue'
import CategoriaNewView from '../views/CategoriaNewView.vue'
import ProductoView from '../views/ProductoView.vue'
import ProductoEditView from '../views/ProductoEditView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/categoria',
      name: 'categoria',
      component: CategoriaView
    },
    {
      path: '/categoria/nuevo',
      name: 'categoria-nuevo',
      component: CategoriaNewView,
    },
    {
      path: '/categoria/editar/:id',
      name: 'categoria-editar',
      component: CategoriaEditView,
      prop: true,
    },
    {
      path: '/producto',
      name: 'producto',
      component: ProductoView
    },
    {
      path: '/producto/editar/:id',
      name: 'producto-editar',
      component: ProductoEditView,
      props: true,
    },
  ]
})

export default router
