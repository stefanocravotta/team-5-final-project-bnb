<template>
    <div class="jumbotron">
            <video autoplay loop muted plays-inline>
                <source :src="'/videos/Hong-Kong.mp4'">
            </video>
            <div class="layer-video">
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
    height: 800px;
    border-radius: 0;
    overflow: hidden;
    position: relative;
    .jumbo-title{
        padding: 15px;
        border-radius: 8px;
        background-color: rgba($color: #000000, $alpha: .4);
        color: white;
    }
    video{
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    min-width: 100%;
    position: absolute;
    z-index: 0;
    }
    .layer-video{
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: 2;
        background-color: rgba($color: #000000, $alpha: 0.6);
    }
}
</style>
