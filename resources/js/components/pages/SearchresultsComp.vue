<template>
    <div class="container">
        <h1>Risultati della ricerca</h1>

        <div v-if="!isFiltered">

            <div  v-for="apartment in apartments" :key="apartment.id" class="mb-4">
                <div>{{ apartment.name}}</div>
                <div>{{ apartment.address }}</div>
            </div>

        </div>

        <div v-else>

            <p v-for="apartment in filtered_apartments" :key="apartment.id">{{ apartment.name}}</p>

        </div>

        <div>
            <div v-for="perk in perks" :key="perk.id" class="d-inline mx-2">
                <label :for="perk.name">{{ perk.name }}</label>
                <input @click="addPerk(perk.id)" type="checkbox" name="perk-box" :id="perk.name" :value="perk.id">
            </div>
        </div>

        <div>
            <button class="btn btn-primary mr-2" v-for="category in categories"
            :key="category.id" @click="addCategory(category.id)">{{category.name}}</button>
        </div>

        <button class="btn btn-secondary mt-3" @click.prevent="applyFilters()">Applica i filtri</button>
        <button class="btn btn-secondary mt-3" @click.prevent="removeFilters()">Rimuovi tutti i filtri</button>

        <div v-if="filtersError" id="filters-error" class="mt-2">Non ci sono filtri da applicare</div>


    </div>
</template>

<script>
export default {
    name: 'SearchresultsComp',
    data(){
        return{
            city: this.$route.params.city,
            apiUrl: '/api/dwellings',
            apartments: null,
            filtersError: false,
            perks: null,
            checkedPerks: [],
            checkedCategories: [],
            categories: null,
            filtered_apartments: [],
            isFiltered: false
        }
    },

    methods:{
        searchDwelling(){

            axios.get(this.apiUrl + '/search-dwelling/' + this.city)
            .then(r =>{
                this.apartments = r.data.dwellings;
                this.perks = r.data.perks;
                this.categories = r.data.categories;
            })
        },

        addPerk(perkId) {
            if (!this.checkedPerks.includes(perkId)) {
                this.checkedPerks.push((perkId));
            } else {
                this.checkedPerks = this.arrayFilter(this.checkedPerks, perkId);
            }
        },

        addCategory(categoryId) {
            if (!this.checkedCategories.includes(categoryId)) {
                this.checkedCategories.push(categoryId);
            } else {
                this.checkedCategories = this.arrayFilter(this.checkedCategories, categoryId);
            }
        },

        arrayFilter(array, value) {

            return array.filter( el =>
                el != value
            );
        },

        applyFilters() {
            if (this.checkedPerks.length > 0 || this.checkedCategories.length > 0) {

                this.filtersError = false;

                let apartments_categories_filtered = [];
                let apartments_perks_filtered = [];

                // se ci sono categorie selezionate
                if (this.checkedCategories.length > 0) {

                    this.apartments.forEach(apartment => {
                        // controllo se la categoria dell'appartamento si trova tra le categorie selezionate
                        if (this.checkedCategories.includes(Number(apartment.category))) {

                            apartments_categories_filtered.push(apartment);
                        }
                    })
                };

                // se ci sono perks selezionati
                if (this.checkedPerks.length > 0) {

                    // per ogni appartamento creo un array con i propri perks
                    this.apartments.forEach(apartment => {

                        let apartmentPerks = [];

                        apartment.perks.forEach(perk => {

                            apartmentPerks.push(perk.id);

                        });

                        // controllo se i perks selezionati si trovano tuttitra i perks dell'appartamento

                        if (this.checkedPerks.every(el => apartmentPerks.includes(el))) {

                            apartments_perks_filtered.push(apartment);
                        }
                    });
                }

                if (apartments_categories_filtered.length == 0) {
                    this.filtered_apartments = apartments_perks_filtered;
                }
                else if (apartments_perks_filtered.length == 0) {
                    this.filtered_apartments = apartments_categories_filtered;
                }
                else if (apartments_categories_filtered.length >= apartments_perks_filtered.length) {
                    this.filtered_apartments = apartments_perks_filtered.filter( el => apartments_categories_filtered.includes(el))
                }
                else if (apartments_perks_filtered.length > apartments_categories_filtered.length) {
                    this.filtered_apartments = apartments_categories_filtered.filter( el => apartments_perks_filtered.includes(el))
                }

                this.isFiltered = true;
            } else {
                this.isFiltered = false;
                this.filtersError = true;
            }
        },

        removeFilters() {
            this.checkedPerks = [];
            this.checkedCategories = [];
            this.filtered_apartments = [];
            this.isFiltered = false;
            this.filtersError = false;
        }

    },
    mounted(){
        this.searchDwelling();
    }
}
</script>

<style lang="scss" scoped>

</style>
