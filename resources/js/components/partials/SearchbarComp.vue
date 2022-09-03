<template>
    <div>
        <!-- <label for="address">address</label> -->
        <!-- <input id="address" type="text" class="searchbar" v-model="address"> -->

        <!-- <label for="city">city</label>
        <input id="city" type="text" class="searchbar" v-model="city" placeholder="Indica in ch citta e paese vuoi andare"> -->

        <div id="searchBox-container">

        </div>
        <!-- <router-link :to="{name:'search-results', params:{ city: city }}" class="search-button d-inline">Cerca</router-link> -->
    </div>
</template>

<script>
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

export default {
    name: 'SearchbarComp',
    data(){
        return{
            address: '',
            city: '',
            options: {
                idleTimePress: 100,
                minNumberOfCharacters: 0,
                searchOptions: {
                    key: '0esiNqmzyhdAgeAwGRM5fRuozF0jWJgO',
                    language: 'it-IT'
                },
                autocompleteOptions: {
                    key: '0esiNqmzyhdAgeAwGRM5fRuozF0jWJgO',
                    language: 'it-IT'
                },
                noResultsMessage: 'No results found.'
            }
        }
    },
    methods:{
        fottutaBarraSearch(){
            const ttSearchBox = new SearchBox(services, this.options);
            const searchBoxHTML = ttSearchBox.getSearchBoxHTML();

            //Attach searchboxHTML to your page
            document.getElementById('searchBox-container').append(searchBoxHTML);
        }
    },
    mounted(){
        this.fottutaBarraSearch()
    }
}
</script>

<style lang="scss" scoped>

.searchbar{
    height: 45px;
    width: 30%;
    // width: 45%;
}
.search-button{
    width: 60px;
    height: 45px;
    padding: 13px;
    background-color: rgb(71, 71, 233);
    color: white;
    border-radius: 4px;
    text-decoration: none;
    & :hover {
        text-decoration: none;
        box-shadow: 5px -10px rgb(71, 71, 233) inset;
    }
}
</style>
