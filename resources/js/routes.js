		// importo vue
		import Vue from 'vue';
		// importo il router
		import VueRouter from 'vue-router';
		// dico a vue di usare VueRouter
		Vue.use(VueRouter);
		// importo i componenti delle rotte
		import HomeComp from './components/HomeComp.vue';
		//creo il router
		const router = new VueRouter({
		    mode: 'history',
            routes: [
                {
                    path: '/',
                    name: 'home',
                    component: HomeComp
                }
            ]
		});
		// lo eporto per poterlo importare dentro front.js che inizializza vue
		export default router;
