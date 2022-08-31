
		// importo vue
		import Vue from 'vue';
		// importo il router
		import VueRouter from 'vue-router';
		// dico a vue di usare VueRouter
		Vue.use(VueRouter);
		// importo i componenti delle rotte
		import HomeComp from './components/HomeComp.vue';
        // import ShowApartment from './components/pages/ShowApartment.vue';

		//creo il router
		const router = new VueRouter({
		    // mode: 'history',
            routes: [
                {
                    path: '/',
                    name: 'home',
                    component: HomeComp
                },
                {
                    path: '/show-apartment',
                    name: 'show-apartment',
                    component: ShowApartment
                },
                {
                    // questa rotta deve stare in coda alle altre
                    path: '*',
                    // component: Error404
                },
            ]
		});
		// lo eporto per poterlo importare dentro front.js che inizializza vue
		export default router;
