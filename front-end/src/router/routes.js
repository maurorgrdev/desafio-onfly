
const routes = [
  {
    path: '/',
    component: () => import('pages/LoginPage.vue'),
  },

  {
    path: '/login',
    component: () => import('pages/LoginPage.vue'),
  },

  {
    path: '/despesa',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Despesa/ListaDespesasPage.vue') }
    ]
  },

  {
    path: '/user',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/User/ListaUsuarioPage.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
