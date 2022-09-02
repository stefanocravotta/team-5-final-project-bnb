<template>
    <div>
        <!-- <label for="address">address</label> -->
        <!-- <input id="address" type="text" class="searchbar" v-model="address"> -->
        <label for="city">city</label>
        <input id="city" type="text" class="searchbar" v-model="city">
        <!-- <div id="searchBox-container">

        </div> -->
        <router-link :to="{name:'search-results', params:{ city: city }}" class="search-button">Cerca</router-link>
    </div>
</template>

<script>
export default {
    name: 'SearchbarComp',
    data(){
        return{
            address: '',
            city: ''
        }
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
