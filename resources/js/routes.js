
		// importo vue
		import Vue from 'vue';
		// importo il router
		import VueRouter from 'vue-router';
		// dico a vue di usare VueRouter
		Vue.use(VueRouter);
		// importo i componenti delle rotte
		import HomeComp from './components/HomeComp.vue';
        import ShowApartment from './components/pages/ShowApartment.vue';
        import SearchresultsComp from './components/pages/SearchresultsComp.vue';
        import ChiSiamoComp from './components/pages/ChiSiamoComp.vue';
		//creo il router
		const router = new VueRouter({
            mode: 'history',
            routes: [
                {
                    path: '/',
                    name: 'home',
                    component: HomeComp
                },
                {
                    path: '/show-apartment/:slug',
                    name: 'show-apartment',
                    component: ShowApartment
                },
                {
                    path: '/search-results/:city',
                    name: 'search-results',
                    component: SearchresultsComp
                },
                {
                    path: '/chi-siamo',
                    name: 'chi-siamo',
                    component: ChiSiamoComp
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
