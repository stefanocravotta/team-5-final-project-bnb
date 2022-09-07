<template>
    <div class="container">
        <h1>Risultati della ricerca</h1>

        <SearchbarComp @searchDwelling="searchDwelling"/>
        <div>
            <div v-if="haveResults">
                <div v-if="!isFiltered" class="d-flex flex-wrap">

                <div v-for="apartment in apartments" :key="apartment.id" class="my-4 mx-2 card w-45 dwellingCard">

                    <router-link :to="{name: 'show-apartment', params:{ slug: apartment.slug}}" class="card-link">
                        <DwellingcardComp :apartment="apartment"/>
                    </router-link>

                </div>

                </div>

                <div v-else>

                <div class="my-4 mx-2 card w-45 dwellingCard" v-for="apartment in filtered_apartments" :key="apartment.id">

                    <router-link :to="{name: 'show-apartment', params:{apartment}}" class="card-link">
                        <DwellingcardComp :apartment="apartment"/>
                    </router-link>

                </div>

                </div>
                <div class="d-flex">
                    <button v-for="perk in perks" :key="perk.id" name="perk-button" :id="`button${perk.name}`"
                    role="radio" aria-checked="false" type="toggle" class="d-flex flex-column perk-button mx-2">
                        <label :for="perk.name" v-html="perk.icon"></label>
                        <label :for="perk.name">{{ perk.name }}</label>
                        <input type="checkbox" @click="addPerk(perk.id,perk.name)" name="perk-box" :id="perk.name"
                        :value="perk.id" style="width: 100%; height: 100%; opacity: 0;" class="perk-link m-0">
                    </button>
                </div>

                <div>
                    <button :id="`category${category.id}`" class="btn btn-primary mr-2" v-for="category in categories"
                    :key="category.id" @click="addCategory(`category${category.id}`)">{{category.name}}</button>
                </div>

                <button class="btn btn-secondary mt-3" @click.prevent="applyFilters(), filtersErrorMethod()">Applica i filtri</button>
                <button class="btn btn-secondary mt-3" @click.prevent="removeFilters()">Rimuovi tutti i filtri</button>

                <div v-if="filtersError" id="filters-error" class="mt-2">Non ci sono filtri da applicare</div>
            </div>
            <div v-else>
                <h3>Non ci sono appartamenti con i seguenti parametri di ricerca</h3>
            </div>
        </div>

        <button class="btn btn-primary m-5" @click="getUser()">user</button>
    </div>
</template>

<script>
import SearchbarComp from '../partials/SearchbarComp.vue';
import DwellingcardComp from '../partials/DwellingcardComp.vue';

export default {
    name: 'SearchresultsComp',
    components: { SearchbarComp, DwellingcardComp },
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
            isFiltered: false,
            haveResults: true
        }
    },

    methods:{

        searchDwelling(city){

            axios.get(this.apiUrl + '/search-dwelling/' + city)
            .then(r =>{
                this.apartments = r.data.dwellings;

                if (this.perks == null && this.categories == null) {
                    this.perks = r.data.perks;
                    this.categories = r.data.categories;
                }

                if(this.apartments.length == 0){
                    this.haveResults = false;
                }
                this.applyFilters();
            })
            .catch((error) =>{
                this.isLoading = false;
            });
        },

        addPerk(perkId,perkName) {

            let button = document.getElementById(`button${perkName}`);
            if (!this.checkedPerks.includes(perkId)) {
                this.checkedPerks.push((perkId));
                button.classList.toggle('active');
            } else {
                this.checkedPerks = this.arrayFilter(this.checkedPerks, perkId);
            }
        },

        addCategory(categoryId) {
            let button = document.getElementById(categoryId);

            if (!this.checkedCategories.includes(categoryId)) {
                this.checkedCategories.push(categoryId);
                button.classList.toggle('selected');
            } else {
                this.checkedCategories = this.arrayFilter(this.checkedCategories, categoryId);
                button.classList.toggle('selected');
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
                        if (this.checkedCategories.includes(`category${apartment.category}`)) {

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
                };

                let checkboxes = document.getElementsByName('perk-box');
                checkboxes.forEach(element => {
                    if (this.checkedPerks.includes(element._value)) {
                        element.checked = true;
                    };
                });

                let categoriesButtons = document.querySelectorAll('button.selected');
                categoriesButtons.forEach(button => {
                    if (this.checkedCategories.includes(button.id)) {
                        button.classList.add('selected');
                    }
                });

                this.isFiltered = true;
            } else {
                this.isFiltered = false;
            }
        },

        filtersErrorMethod() {
            if (this.checkedPerks == [] && this.checkedCategories == []) {
                this.filtersError = true;
            }
        },

        removeFilters() {
            this.checkedPerks = [];
            this.checkedCategories = [];
            this.filtered_apartments = [];
            this.isFiltered = false;
            this.filtersError = false;
            let buttons = document.getElementsByName('perk-button');
            buttons.forEach(button =>{
                button.classList.remove('active');
            })
            let checkboxes = document.getElementsByName('perk-box');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkbox.checked = false;
                }
            });
            let categoriesButtons = document.querySelectorAll('button.selected');
            categoriesButtons.forEach(button => {
                button.classList.remove('selected');
            });
        },
    },
    mounted() {
        this.searchDwelling(this.city);
    }
}
</script>

<style lang="scss" scoped>

    button.selected {
        color: rgb(172, 23, 23);
        border: 2px solid rgb(172, 23, 23);
    }

.dwellingCard{
    border: 1px solid black;
    border-radius: 5px;

    .card-link{
        text-decoration: none;
        color: black;

        &:hover {
            color: blue;
        }
    }
}

</style>
