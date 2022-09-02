<template>
    <div>
        <input type="text" class="searchbar" v-model="apartment">
        <router-link :to="{name:'search-results', params:{ apartment: apartment }}" class="search-button">Cerca</router-link>
    </div>
</template>

<script>
export default {
    name: 'SearchbarComp',
    data(){
        return{
            apartment: ''
        }
    }
}
</script>

<style lang="scss" scoped>
.searchbar{
    height: 45px;
    width: 45%;
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
