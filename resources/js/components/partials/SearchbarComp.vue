<template>
    <div class="d-flex align-items-center">
        <div class="w-75" id="searchBox-container">


        </div>
        <router-link :to="{name:'search-results', params:{ city: city }}" class="search-button d-inline"><span @click="getValue()">Cerca</span></router-link>
    </div>
</template>

<script>
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

export default {
    name: 'SearchbarComp',
    data(){
        return{
            city: '',
            address: '',
            options: {
                idleTimePress: 100,
                minNumberOfCharacters: 0,
                searchOptions: {
                    key: 'sXZ074rJ8QHr7ocOwfW5NaIHLwTog1tx',
                    language: 'it-IT'
                },
                autocompleteOptions: {
                    key: 'sXZ074rJ8QHr7ocOwfW5NaIHLwTog1tx',
                    language: 'it-IT'
                },
                noResultsMessage: 'No results found.'
            }
        }
    },
    methods:{
        searchBarCreator(){
            const ttSearchBox = new SearchBox(services, this.options);
            const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            //Attach searchboxHTML to your page
            document.getElementById('searchBox-container').append(searchBoxHTML);
        },

        // PRENDE IL VALORE AL CLICK DEL PULSANTE
        getValue(){
            let inputSearchBox = document.querySelector('.tt-search-box-input');
            this.city = inputSearchBox.value;
            console.log(this.city)
        }
    },
    mounted(){
        this.searchBarCreator()
    }
}
</script>

<style lang="scss" scoped>

.search-button{
    margin: 12px 0 0 10px;
    padding: 10px 19px;
    background-color: rgb(71, 71, 233);
    color: white;
    border-radius: 6px;
    text-decoration: none;
    & :hover {
        text-decoration: none;
        box-shadow: 5px -10px rgb(71, 71, 233) inset;
    }
}
</style>
