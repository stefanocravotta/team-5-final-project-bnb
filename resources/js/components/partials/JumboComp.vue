<template>
    <div class="jumbotron">
        <div class="container">
            <div class="jumbo-title w-50">
                <h2>Prenota l'albergo/appartamento/casa/Villa migliore per le tue vacanze</h2>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'JumboComp'
}
</script>

<style lang="scss" scoped>
.jumbotron{
    height: 400px;
    background-color: #003580;
    border-radius: 0;
    .jumbo-title{
        padding: 15px;
        border-radius: 8px;
        background-color: rgba($color: #000000, $alpha: .4);
        color: white;
    }
}
</style>
