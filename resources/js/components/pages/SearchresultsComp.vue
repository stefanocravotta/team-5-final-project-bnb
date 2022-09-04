<template>
    <div class="container">
        <h1>Risultati della ricerca</h1>

        <div v-if="!isFiltered">

            <p v-for="apartment in apartments" :key="apartment.id">{{ apartment.name}}</p>

        </div>

        <div v-if="isFiltered">

            <p v-for="apartment in filtered_apartments" :key="apartment.id">{{ apartment.name}}</p>

        </div>

        <form id="perk-form">
            <div v-for="perk in perks" :key="perk.id" class="d-inline mx-2">
                <label :for="perk.name">{{ perk.name }}</label>
                <input type="checkbox" name="perk-box" :id="perk.name" :value="perk.id">
            </div>

            <button type="submit" @click.prevent="checkPerks()">Go!</button>
        </form>

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
            categories: null,
            filtered_apartments: [],
            isFiltered: false
        }
    },

    methods:{
        searchDwelling(){

            axios.get(this.apiUrl + '/search-dwelling/' + this.apartmentSearch)
            .then(r =>{
                this.apartments = r.data.dwellings;
                this.perks = r.data.perks;
                this.categories = r.data.categories;
                // console.log(r.data);
            })
        },

        searchByCategory(categoryId){
            let pivot_array = [];
            this.apartments.forEach(el =>{

                if(el.category == categoryId){
                    pivot_array.push(el)
                }


            })
            this.filtered_apartments = pivot_array;
            this.isFiltered = true;

            // console.log('ciao', categoryId);
            // console.log('apartment', this.apartmentSearch);

            // ALTERNATIVA CON CHIAMATA AXIOS

            // axios.get(this.apiUrl + '/search-category/' + categoryId + '/' + this.apartmentSearch)
            // .then(r =>{
            //     this.apartments = r.data.apartment;
            //     console.log(r.data.apartment);

            // })
        },

        checkPerks(){
            let checked = [];

            // Prendo i valori dei perk che ho cercato e li salvo il un array
            let markedCheckbox = document.getElementsByName('perk-box');
            for (let checkbox of markedCheckbox) {
                if (checkbox.checked){ checked.push(checkbox.value) }
            }
            // console.log(checked);

            let perked_apartments = [];
            let apartment_perk_arr = [];
            this.apartments.forEach(apartment => {
                // console.log(apartment.perks);
                apartment.perks.forEach(perk => {

                    // Restituisce un array di array con parametri chiave - valore;
                    for (const [key, value] of Object.entries(perk)) {
                        console.log(`${key}: ${value}`);
                    }
                });
            });
        }


    },
    mounted(){
        this.searchDwelling();
    }
}
</script>

<style lang="scss" scoped>

</style>
