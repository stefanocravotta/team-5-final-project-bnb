<template>
    <div class="jumbotron" id="top">
            <video autoplay loop muted plays-inline>
                <source :src="'/videos/Hong-Kong.mp4'">
            </video>
            <div class="layer-video">
                <!-- <div class="jumbo-title w-50">
                    <h2>Prenota l'albergo/appartamento/casa/Villa migliore per le tue vacanze</h2>
                </div> -->

                <div class="box">
                    <div><h2>Experience the Stoke difference at Adelaide's Showroom!</h2></div>
                    <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae et fuga sequi eaque laborum consequatur cupiditate illo, exercitationem quos doloribus cumque illum, minus alias corporis vitae enim provident sunt! Itaque?</div>
                    <div  class="arrow">freccia sx</div>
                    <div  class="arrow-dx">freccia dx</div>
                    </div>

            </div>
    </div>
</template>

<script>
export default {
    name: 'JumboComp',
}

</script>

<style lang="scss" scoped>
.jumbotron{
    height: 500px;
    border-radius: 0;
    overflow: hidden;
    position: relative;
    // color: white;
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

        overflow-y: hidden;
        right: 0;
        position: absolute;
        z-index: 2;
        background-color: rgba($color: #000000, $alpha: 0.6);
    }
    .box{

        width: 25%;
        height: 60%;
        padding: 30px;
        // background-color: rgb(207, 203, 203);
        // background-color: #95A3B3;
        background-color: #FAFAFA;
        margin-top: 80px;
        margin-left: 80px;
        position: relative;
    }.arrow{
        position: absolute;
        bottom: 0;
        left: 0;
    }.arrow-dx{
        position: absolute;
        bottom: 0;
        right: 0;
    }
}

</style>
