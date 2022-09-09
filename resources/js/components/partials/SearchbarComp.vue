<template>
    <div class="d-flex  min-width">

        <div class="w-100" id="searchBox-container">


        </div>

        <router-link :to="{name:'search-results' , params:{city: city}}" class="search-button d-inline"><span @click="getValue()" >Cerca</span></router-link>
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
    // props: {
    //     checkboxes: Array,
    // },
    methods:{
        searchBarCreator(){
            const ttSearchBox = new SearchBox(services, this.options);
            const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            //Attach searchboxHTML to your page
            document.getElementById('searchBox-container').append(searchBoxHTML);
            document.querySelector('.tt-search-box-input-container').setAttribute('style', 'border-radius: 6px;')
            document.querySelector('.tt-search-box').setAttribute('style', 'border-radius: 6px;')
        },

        // PRENDE IL VALORE AL CLICK DEL PULSANTE
        getValue(){
            let inputSearchBox = document.querySelector('.tt-search-box-input');
            this.city = inputSearchBox.value.replaceAll(' ' , '-').toLowerCase();
            this.$emit('searchDwelling', this.city);
        }
    },
    mounted(){
        this.searchBarCreator()
    }
}
</script>

<style lang="scss" scoped>

 .min-width{
     width: 60%;
     margin-right: 10px;
}
.search-button{
    margin: 12px 0 0 10px;
    padding: 10px 19px;
    border-radius: 6px;
    font-size: 0.9rem;
    background-color: rgb(71, 71, 233);
    color: white;
    text-decoration: none;
    & :hover {
        text-decoration: none;
        box-shadow: 5px -10px rgb(71, 71, 233) inset;
    }
}
</style>
