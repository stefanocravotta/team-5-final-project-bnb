<template>
    <div class="container">
        <h1>Risultati della ricerca</h1>
        <p>{{$route.params.city}}</p>

        <p v-for="apartment in apartments" :key="apartment.id">{{ apartment.name}}</p>

        <button class="btn btn-primary mx-2" v-for="category in categories" :key="category.id" @click="searchByCategory(category.id)">{{category.name}}</button>
    </div>
</template>

<script>
export default {
    name: 'SearchresultsComp',
    data(){
        return{
            apartmentSearch: this.$route.params.city,
            apiUrl: '/api/dwellings',
            apartments: null,
            perks: null,
            categories: null
        }
    },

    methods:{
        searchDwelling(){

            axios.get(this.apiUrl + '/search-dwelling/' + this.apartmentSearch)
            .then(r =>{
                this.apartments = r.data.dwellings;
                this.perks = r.data.perks;
                this.categories = r.data.categories;
                console.log(r.data);
            })
        },

        searchByCategory(categoryId){




            // console.log('ciao', categoryId);
            // console.log('apartment', this.apartmentSearch);

            // axios.get(this.apiUrl + '/search-category/' + categoryId + '/' + this.apartmentSearch)
            // .then(r =>{
            //     this.apartments = r.data.apartment;
            //     console.log(r.data.apartment);

            // })
        }
    },
    mounted(){
        this.searchDwelling();
    }
}
</script>

<style lang="scss" scoped>

</style>
