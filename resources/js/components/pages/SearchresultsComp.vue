<template>
    <div>
        <h1>Risultati della ricerca</h1>
        <p>{{$route.params.city}}</p>

        <p v-for="apartment in apartments" :key="apartment.id">{{ apartment.name}}</p>
    </div>
</template>

<script>
export default {
    name: 'SearchresultsComp',
    data(){
        return{
            apartmentSearch: this.$route.params.city,
            apiUrl: '/api/dwellings',
            apartments: null
        }
    },

    methods:{
        searchDwelling(){

            axios.get(this.apiUrl + '/search-dwelling/' + this.apartmentSearch)
            .then(r =>{
                this.apartments = r.data.dwellings
                console.log(r.data);
            })
        }
    },
    mounted(){
        this.searchDwelling();
    }
}
</script>

<style lang="scss" scoped>

</style>
