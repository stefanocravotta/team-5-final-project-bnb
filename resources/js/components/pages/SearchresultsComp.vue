<template>
    <div class="d-flex">

        <div class="container-left px-2">
            <h2 class="text-center">Risultati della ricerca</h2>

            <div class="d-flex align-items-center justify-content-center">
                <SearchbarComp @searchDwelling="searchDwelling" :range="range"/>
                <b-button id="show-btn" class="ml-1" @click="showModal"><i class="fa-solid fa-list"></i> Filtri</b-button>
            </div>

            <div class="d-flex justify-content-center ">
                <div>

                    <b-modal ref="my-modal" hide-footer title="Applica i filtri">
                    <div class="d-block text-center">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center flex-wrap py-3">
                                <button v-for="perk in perks" :key="perk.id" name="perk-button" :id="`button${perk.id}`"
                                    role="radio" aria-checked="false" type="toggle" class="d-flex flex-column align-items-center perk-button mx-2">
                                    <label v-html="perk.icon"></label>
                                    <label>{{ perk.name }}</label>
                                    <input type="checkbox" @click="addPerk(perk.id)" name="perk-box" :id="perk.name"
                                    :value="perk.id" class="perk-link m-0">
                                </button>
                            </div>

                            <div class="d-flex" id="requiredFilters">
                                <div>
                                    <label for="beds">Numero minimo letti</label>
                                    <input v-model="filters.beds" type="number" name="beds">
                                </div>

                                <div>
                                    <label for="rooms">Numero minimo stanze</label>
                                    <input v-model="filters.rooms" type="number" name="rooms">
                                </div>

                                <div>
                                    <label for="distance">Raggio di ricerca:{{range}}</label>
                                    <input v-model="range" type="range" name="distance" min="4" max="40" value="20">
                                </div>
                            </div>

                            <div>
                                <button name="categories" :id="`category${category.id}`" class="btn-gold mr-2 mb-2" v-for="category in categories" :key="category.id" @click="addCategory(`category${category.id}`)">
                                {{category.name}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between" >
                        <button class="btn btn-primary mt-3" @click.prevent="applyFilters(), filtersErrorMethod()">Applica filtri</button>
                        <button class="btn btn-danger mt-3" @click.prevent="removeFilters()">Rimuovi tutti i filtri</button>
                    </div>
                </b-modal>
                </div>
                <div v-if="filtersError" id="filters-error" class="mt-2">Non ci sono filtri da applicare</div>
            </div>

            <div id="cardsContainer" class="mt-4">

                <div v-if="haveResults">

                    <div v-if="!isFiltered" class="container-fluid _container">
                        <div class="row d-flex flex-wrap justify-content-center">

                            <DwellingcardComp class="dwellingCard" v-for="apartment in apartments" :key="apartment.id" :apartment="apartment" :categories="categories" :ip_address="ip_address"/>

                        </div>
                    </div>

                    <div v-else class="container-fluid _container">
                        <div class="row d-flex justify-content-center flex-wrap">

                            <DwellingcardComp v-for="apartment in filtered_apartments" :key="apartment.id" class="dwellingCard" :apartment="apartment" :categories="categories" :ip_address="ip_address"/>

                        </div>
                    </div>

                </div>

                <div v-else>
                    <h3 class="ml-5 pl-4">Ci dispiace! La ricerca non ha prodotto risultati :(</h3>
                </div>


            </div>

        </div>


        <div id="map-box" class="d-none d-md-block">

            <MapComp v-if="apartments.length > 0 && coordinates != null && isFiltered == false" :apartments="apartments" :coordinates="coordinates" :range="range"/>

            <MapComp v-else-if="isFiltered == true && filtered_apartments.length > 0" :apartments="filtered_apartments" :coordinates="coordinates" :range="range"/>

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
            range: '20',
            oldRange: null,
            filters: {
                beds: null,
                rooms: null,
                checkedPerks: [],
                checkedCategories: []
            },
            apartments: [],
            filtersError: false,
            perks: null,
            categories: null,
            filtered_apartments: [],
            isFiltered: false,
            haveResults: true,
            ip_address: null
        }
    },

    methods: {
        showModal() {
        this.$refs['my-modal'].show();

        let oldFilters = setTimeout(() => {

            let checkboxes = document.getElementsByName('perk-box');

            checkboxes.forEach(element => {

                if (this.filters.checkedPerks.includes(element._value)) {
                    let button = document.getElementById(`button${element._value}`);
                    element.checked = true;
                    button.classList.toggle('active');
                };
            });

            let categoriesButtons = document.getElementsByName('categories');
            categoriesButtons.forEach(button => {
                if (this.filters.checkedCategories.includes(button.id)) {
                    button.classList.add('selected');
                }
            });
        }, 100);
        },

        searchDwelling(city, range){

            this.apartments = [];
            this.coordinates = null;

            axios.get(this.apiUrl + '/search-dwelling/' + city + '/' + range)
            .then(r =>{

                this.apartments = r.data.dwellings;
                this.coordinates = r.data.coordinates;
                this.oldRange = range;
                this.city = city;

                if (this.perks == null && this.categories == null) {
                    this.perks = r.data.perks;
                    this.categories = r.data.categories;
                }

                if(this.apartments.length == 0){
                    this.haveResults = false;
                }else{
                    this.haveResults = true;
                }
                this.applyFilters();
            })
            .catch((error) =>{
                console.log(error);
            });

            this.filtersError = false;
        },

        addPerk(perkId) {

            let button = document.getElementById(`button${perkId}`);
            if (!this.filters.checkedPerks.includes(perkId)) {
                this.filters.checkedPerks.push((perkId));
                button.classList.toggle('active');
            } else {
                this.filters.checkedPerks = this.arrayFilter(this.filters.checkedPerks, perkId);
                button.classList.toggle('active');
            }
        },

        addCategory(categoryId) {
            let button = document.getElementById(categoryId);

            if (!this.filters.checkedCategories.includes(categoryId)) {
                this.filters.checkedCategories.push(categoryId);
                button.classList.toggle('selected');
            } else {
                this.filters.checkedCategories = this.arrayFilter(this.filters.checkedCategories, categoryId);
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

            if (this.range != this.oldRange) {
                this.searchDwelling(this.city, this.range);
                return;
            }

            if (this.apartments.length > 0) {
                this.haveResults = true;
            }

            if (this.filters.checkedPerks.length > 0 || this.filters.checkedCategories.length > 0
                || this.filters.beds != null || this.filters.rooms != null) {

                this.filtered_apartments = [];
                this.isFiltered = true;

                const applyFilters = setTimeout(() => {

                    this.filtersError = false;

                    let filtersResults = [];

                    if (this.filters.beds != null) {
                        filtersResults["apartments_beds_filtered"] = [];
                        filtersResults['apartments_beds_filtered'] = this.apartments.filter(apartment => apartment.beds >= this.filters.beds)
                    }

                    if (this.filters.rooms != null) {
                        filtersResults["apartments_rooms_filtered"] = [];
                        filtersResults['apartments_rooms_filtered'] = this.apartments.filter(apartment => apartment.rooms >= this.filters.rooms)
                    }

                    // se ci sono categorie selezionate
                    if (this.filters.checkedCategories.length > 0) {
                        filtersResults["apartments_categories_filtered"] = [];
                        this.apartments.forEach(apartment => {
                            // controllo se la categoria dell'appartamento si trova tra le categorie selezionate
                            if (this.filters.checkedCategories.includes(`category${apartment.category}`)) {

                                filtersResults['apartments_categories_filtered'].push(apartment);
                            }
                        })
                    };

                    // se ci sono perks selezionati
                    if (this.filters.checkedPerks.length > 0) {
                        filtersResults["apartments_perks_filtered"] = [];
                        // per ogni appartamento creo un array con i propri perks
                        this.apartments.forEach(apartment => {

                            let apartmentPerks = [];

                            apartment.perks.forEach(perk => {

                                apartmentPerks.push(perk.id);

                            });

                            // controllo se i perks selezionati si trovano tutti tra i perks dell'appartamento

                            if (this.filters.checkedPerks.every(el => apartmentPerks.includes(el))) {

                                filtersResults['apartments_perks_filtered'].push(apartment);
                            }
                        });
                    }

                    let filtersSummary = [];

                    filtersResults = Object.entries(filtersResults);


                    filtersResults.forEach(element => {
                        filtersSummary = filtersSummary.concat(element[1]);
                    });

                    filtersSummary.forEach(element => {
                        if (this.ripetitionsCount(filtersSummary, element) == filtersResults.length && !this.filtered_apartments.includes(element)) {
                            this.filtered_apartments.push(element);
                        }
                    });

                    if (this.filtered_apartments.length == 0) {
                        this.haveResults = false;
                    }

                }, 300);
            }
            else {
                this.filtered_apartments = [];
                const setFilteredFalse = setTimeout(() => {
                    this.isFiltered = false;
                }, 300);
            }

        },

        ripetitionsCount(array, value) {

            let count = 0;
            array.forEach(element => {
                if (element == value) {
                    count++;
                }
            });
            return count;
        },

        filtersErrorMethod() {
            if (this.filters.checkedPerks.length == 0 && this.filters.checkedCategories.length == 0 && this.filters.beds == null && this.filters.rooms == null && this.range != "20") {
                this.filtersError = true;
            }
        },

        removeFilters() {
            this.$refs['my-modal'].hide()
            this.filters.checkedPerks = [];
            this.filters.checkedCategories = [];
            this.filtered_apartments = [];
            this.filtersError = false;
            this.filters.beds = null;
            this.filters.rooms = null;
            this.range = "20";
            if (this.apartments.length > 0) {
                this.haveResults = true;
            }

            const setFilteredFalse = setTimeout(() => {
                    this.isFiltered = false;
                }, 300);
        },
        getIdAddress() {
            axios.get('https://api.ipify.org?format=json')
            .then(res =>{
                this.ip_address = res.data.ip;
            })
            .catch((error) =>{
                console.log(error);
            });
        }

    },

    mounted() {
        this.searchDwelling(this.city, this.range);
        this.getIdAddress();
    }

}
</script>

<style lang="scss" scoped>

#requiredFilters {
    margin-bottom: 20px;
    & > div {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 30%;
        margin-right: 15px;

        &:not(:last-child) > input{
            width: 50%;
        }
    }
}
.container-left{
    max-height: 80vh;
}
#show-btn{
    height: 43px;
    padding: 10px 19px;
    margin-left: -40px;
}
.active{
    opacity: 1;
    color: #3490DC;
}

#map-box{
width: 50%;

}
button.selected {
    color: rgb(172, 23, 23);
    border: 2px solid rgb(172, 23, 23);
}

._container{
    padding-left: 0;
}

#cardsContainer {
    max-height: 80%;
    overflow-y: scroll;
}

.dwellingCard{
    // border: 1px solid black;
    border-radius: 5px;
    overflow: hidden;
    padding: 0;
}

input.perk-link {
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 20;
}
</style>
