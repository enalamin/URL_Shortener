import { createRouter, createWebHistory } from "vue-router";

import UrlIndex from '../components/urlshortner/UrlsIndex.vue'


const routes = [
    {
        path: '/url',
        name: 'urls.index',
        component: UrlIndex
    },
    // {
    //     path: '/url/create',
    //     name: 'urls.create',
    //     component: UrlCreate
    // },
    // {
    //     path: '/companies/:id/edit',
    //     name: 'companies.edit',
    //     component: CompaniesEdit,
    //     props: true
    // }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
