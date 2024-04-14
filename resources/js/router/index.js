import {createRouter, createWebHistory} from "vue-router";

import Home from "../components/pages/Home.vue";

const routes =[
    {
        path: '/',
        component: Home,
        name: 'Home'
    },
    {
        path: '/:slug*',
        name: 'Redirect',
        // This is just a placeholder component, it won't be rendered
        component: { template: '<div></div>' },
    }
    ];


const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const pathname = to.href;
    console.log(to.name);
    if (pathname !== '/') {
        const slug = pathname.split('/')[1]; // Get the slug from pathname

        // Remove any trailing slashes from the slug
        const cleanedSlug = slug.replace(/\/$/, '');

        // Redirect to the external link based on the cleaned slug
        window.location.href = `https://shorten.dev/api/${cleanedSlug}`;
    } else {
        // Continue to the next route
        next();
    }
});
export default router
