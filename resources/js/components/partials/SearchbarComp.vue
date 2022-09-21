<template>
    <div class="flex-grow-1" style="max-width: 500px">

        <div class="d-flex align-items-center">
            <div id="searchBox-container">


            </div>

            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-button d-inline"><span class="search-span"   @click="getValue()" >Cerca</span></router-link>

        </div>
        <div class="mt-2" v-show="error == true">Stai forse cercando l'isola che non c'è?</div>
    </div>
</template>

<script>
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

export default {
    name: 'SearchbarComp',
    data(){
        return{
            error: false,
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
    props: {
        range: String
    },
    methods:{
        searchBarCreator(){
            const ttSearchBox = new SearchBox(services, this.options);
            const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            //Attach searchboxHTML to your page
            document.getElementById('searchBox-container').append(searchBoxHTML);
            document.getElementById('searchBox-container').setAttribute('style', 'flex-grow: 1;');
            document.querySelector('.tt-search-box-input-container').setAttribute('style', 'border-radius: 6px;')
            document.querySelector('.tt-search-box').setAttribute('style', 'border-radius: 6px; margin-top: 0;')
        },

        // PRENDE IL VALORE AL CLICK DEL PULSANTE
        getValue(){
            let inputSearchBox = document.querySelector('.tt-search-box-input').value;
            if (inputSearchBox != "") {
                this.city = inputSearchBox.replaceAll(' ' , '-').toLowerCase();
                this.$emit('searchDwelling', this.city, this.range);
            } else{
                this.error = true;
            }

        }
    },
    mounted(){
        this.searchBarCreator()
    }
}
</script>

<style lang="scss" scoped>

 .min-width{
     width: 80%;
     margin: 0 auto;
}
.search-button{
    margin: 0 10px;
    padding: 10px 0;
    border-radius: 6px;
    font-size: 0.9rem;
    background-color: rgb(71, 71, 233);
    color: white;
    text-decoration: none;
    & :hover {
        text-decoration: none;
    }
    .search-span {
        padding: 12px 32px;
    }
}
</style>
