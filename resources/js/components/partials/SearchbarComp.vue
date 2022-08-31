<template>
    <div>
        <input type="text" class="searchbar">
        <a href="#" class="search-button">Cerca</a>
    </div>
</template>

<script>
export default {
    name: 'SearchbarComp'
}
</script>

<style lang="scss" scoped>
.searchbar{
    height: 45px;
    width: 45%;
}
.search-button{
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
