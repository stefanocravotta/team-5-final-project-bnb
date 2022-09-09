<template>
    <div class="jumbotron" id="top">
            <video autoplay loop muted plays-inline>
                <source :src="'/videos/Hong-Kong.mp4'">
            </video>
            <div class="layer-video">
                <!-- <div class="jumbo-title w-50">
                    <h2>Prenota l'albergo/appartamento/casa/Villa migliore per le tue vacanze</h2>
                </div> -->

                <!-- <div class="box">
                    <div><h2>Experience the Stoke difference at Adelaide's Showroom!</h2></div>
                    <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae et fuga sequi eaque laborum consequatur cupiditate illo, exercitationem quos doloribus cumque illum, minus alias corporis vitae enim provident sunt! Itaque?</div>
                    <div  class="arrow">freccia sx</div>
                    <div  class="arrow-dx">freccia dx</div>
                </div> -->
                <div class="box"><h2>Benvenuto {{userName}} </h2></div>
                <!-- <div class="d-flex txt-wrap">
                         <div class="show-text">BENVENUTO</div>
                </div> -->
                <!-- <div class="show-text">
                        <span>Cerca la miglior offerta tra case, ville e molto altro! <br></span>
                        <span>Goditi le vacanze, al resto pensiamo noi.</span>
                </div> -->




            </div>
    </div>
</template>

<script>
export default {
    name: 'JumboComp',
        data(){
            return{
                userName : window.User.name,
            }
        }
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
    }.box{
        max-width: 35%;
        border-radius: 20px;
        max-height: 35px;
        background-color: #282f35;
        text-align: center;
        margin-top: 10px;
        margin-left: 80px;
        animation-name: test;
        animation-duration: 3s;
        position: relative;
    }
    @keyframes test {
        0%{width: 0%; color:transparent; opacity: 0;}
        40%{ color:rgba($color: #beb7a4, $alpha: 0.2);opacity: 0.4;}
        60%{ color:rgba($color: #beb7a4, $alpha: 0.4);opacity: 0.6;}
        70%{ color:rgba($color: #beb7a4, $alpha: 0.5);opacity: 0.6;}
        80%{ color:rgba($color: #beb7a4, $alpha: 0.6);opacity: 0.6;}
        90%{ color:rgba($color: #beb7a4, $alpha: 0.7);opacity: 0.6;}
        99%{ color:rgba($color: #beb7a4, $alpha: 0.8);opacity: 0.8;}
        100%{width: 100%; opacity: 1;}
    }
    .txt-wrap{
        max-width: 100%;
        justify-content: center;
    }
    .show-text{
        display: flex;
        justify-content: center;
        border-radius: 20px;
        background-color: #282f35;
        font-size: 50px;
        width: 30%;
        animation-name: test2;
        animation-duration: 1s;
    }
    @keyframes test2 {
        0%{width: 0%; color:transparent; opacity: 0;}
        40%{ color:transparent;}
        60%{ color:transparent;}
        99%{ color:transparent;}
        100%{width: 30%; opacity: 1;}
    }
    .arrow{
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
