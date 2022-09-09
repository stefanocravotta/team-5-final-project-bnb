<template>
    <div class="container">
        <h1>Risultati della ricerca</h1>

        <div class="d-flex">

        <SearchbarComp @searchDwelling="searchDwelling"/>
            <b-button id="show-btn" class="py-0" @click="showModal"><i class="fa-solid fa-list"></i> Applica i tuoi filtri</b-button>
        </div>

        <div class="d-flex justify-content-center pt-3 w-50">
            <div>

                <b-modal ref="my-modal" hide-footer title="Applica i filtri">
                <div class="d-block text-center">
                    <div class="d-flex flex-column ">
                        <div class="d-flex flex-wrap">
                            <button v-for="perk in perks" :key="perk.id" name="perk-button" :id="`button${perk.id}`"
                                role="radio" aria-checked="false" type="toggle" class="d-flex flex-column perk-button mx-2">
                                <label v-html="perk.icon"></label>
                                <label>{{ perk.name }}</label>
                                <input type="checkbox" @click="addPerk(perk.id)" name="perk-box" :id="perk.name"
                                :value="perk.id" class="perk-link m-0">
                            </button>
                        </div>
                        <div>
                            <button :id="`category${category.id}`" class="btn btn-primary mr-2 mb-2" v-for="category in categories"
                            :key="category.id" @click="addCategory(`category${category.id}`)">{{category.name}}</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between" >
                    <b-button class="btn btn-secondary mt-3" @click.prevent="applyFilters(), filtersErrorMethod()">Applica filtri</b-button>
                    <b-button class="btn btn-secondary mt-3" @click.prevent="removeFilters()">Rimuovi tutti i filtri</b-button>
                </div>
            </b-modal>
            </div>
            <div v-if="filtersError" id="filters-error" class="mt-2">Non ci sono filtri da applicare</div>
        </div>

        <div class="d-flex mt-4">

            <div v-if="haveResults" class="w-50">

                <div v-if="!isFiltered" class="container-fluid _container">
                    <div class="raw d-flex flex-wrap">
                        <div v-for="apartment in apartments" :key="apartment.id" class="mb-2 mr-4 col-11 col-lg-5 card dwellingCard">

                        <router-link :to="{name: 'show-apartment', params:{ slug: apartment.slug}}" class="card-link">
                            <DwellingcardComp :apartment="apartment"/>
                        </router-link>

                        </div>
                    </div>
                </div>

                <div v-else class="container-fluid _container">
                    <div class="raw d-flex flex-wrap">
                        <div v-for="apartment in filtered_apartments" :key="apartment.id" class="mb-2 mr-4 col-11 col-lg-5 card dwellingCard">

                            <router-link :to="{name: 'show-apartment', params:{ slug: apartment.slug}}" class="card-link">
                                <DwellingcardComp :apartment="apartment"/>
                            </router-link>

                        </div>
                    </div>
                </div>

            </div>
            <div v-else class="w-50">
                <h3>Non ci sono appartamenti con i seguenti parametri di ricerca</h3>
            </div>

            <MapComp v-if="apartments != null && coordinates != null && isFiltered == false" :apartments="apartments" :coordinates="coordinates" class="w-50"/>

            <MapComp v-else-if="isFiltered == true && filtered_apartments != null" :apartments="filtered_apartments" :coordinates="coordinates" class="w-50"/>

        </div>
    </div>
</template>

<script>
import SearchbarComp from '../partials/SearchbarComp.vue';
import DwellingcardComp from '../partials/DwellingcardComp.vue';
import MapComp from '../partials/MapComp.vue';

export default {
    name: 'SearchresultsComp',
    components: { SearchbarComp, DwellingcardComp, MapComp },
    data(){
        return{
            city: this.$route.params.city,
            apiUrl: '/api/dwellings',
            coordinates: null,
            apartments: null,
            filtersError: false,
            perks: null,
            checkedPerks: [],
            checkedCategories: [],
            categories: null,
            filtered_apartments: null,
            isFiltered: false,
            haveResults: true
        }
    },

    methods:{

        showModal() {
        this.$refs['my-modal'].show()
        },

        searchDwelling(city){

            this.apartments = null;
            this.coordinates = null;
            this.filtersError = false;

            axios.get(this.apiUrl + '/search-dwelling/' + city)
            .then(r =>{
                this.apartments = r.data.dwellings;
                this.coordinates = r.data.coordinates;

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
                console.log(error);
            });
        },

        addPerk(perkId) {

            let button = document.getElementById(`button${perkId}`);
            if (!this.checkedPerks.includes(perkId)) {
                this.checkedPerks.push((perkId));
                button.classList.toggle('active');
            } else {
                this.checkedPerks = this.arrayFilter(this.checkedPerks, perkId);
                button.classList.toggle('active');
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
            this.$refs['my-modal'].hide();
            if (this.checkedPerks.length > 0 || this.checkedCategories.length > 0) {

                this.filtered_apartments = null;
                this.isFiltered = true;

                const applyFilters = setTimeout(() => {

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
                }, 300);
            }
            else {
                this.filtered_apartments = null;
                const setFilteredFalse = setTimeout(() => {
                    this.isFiltered = false;
                }, 300);
            }

        },

        filtersErrorMethod() {
            if (this.checkedPerks.length == 0 && this.checkedCategories.length == 0) {
                this.filtersError = true;
            }
        },

        removeFilters() {
            this.$refs['my-modal'].hide()
            this.checkedPerks = [];
            this.checkedCategories = [];
            this.filtered_apartments = null;
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

            const setFilteredFalse = setTimeout(() => {
                    this.isFiltered = false;
                }, 300);
        },

        // setStyles() {
        //    let popups = document.querySelectorAll('div');
        //    console.log(popups);
        //    popups.forEach(popup => {
        //        popup.setAttribute('style','color: black;')
        //    });
        // }
    },

    mounted() {
        this.searchDwelling(this.city);
        // this.setStyles();
    }

}
</script>

<style lang="scss" scoped>
.active{
    opacity: 1;
    color: #3490DC;
}

button.selected {
    color: rgb(172, 23, 23);
    border: 2px solid rgb(172, 23, 23);
}

._container{
    padding-left: 0;
}

.dwellingCard{
    border: 1px solid black;
    border-radius: 5px;
    overflow: hidden;
    padding: 0;

    .card-link{
        text-decoration: none;
        color: black;
        margin-left: 0;

        &:hover {
            color: blue;
        }
    }
}

input.perk-link {
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 20;
}
</style>
