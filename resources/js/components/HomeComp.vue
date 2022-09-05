<template>
    <div>
        <JumboComp />
        <div class="container">
            <SearchbarComp />
            <h1>Homepage</h1>
            <h4>Welcome to the homepage of our website!</h4>
        </div>
        <div class="content d-flex">
            <!-- INIZIO COLONNA SINISTRA -->
            <!-- <div class="sx-cont">
                <h3>Filtra la tua ricerca</h3>
                <hr>
            </div> -->
            <!-- FINE COLONNA SINISTRA -->



            <!-- INIZIO COLONNA DESTRA -->
            <div class="dx-cont d-flex">

                <h3>Visita tutti gli appartamenti</h3>
                <div class="img-sec d-flex ">
                    <div class="box d-flex">
                        <div>
                            immagine
                        </div>
                        <div>titolo</div>
                        <div>prezzo</div>
                    </div>
                    <div class="box d-flex">
                        <div>
                            immagine
                        </div>
                        <div>titolo</div>
                        <div>prezzo</div>
                    </div>
                    <div class="box d-flex">
                        <div>
                            immagine
                        </div>
                        <div>titolo</div>
                        <div>prezzo</div>
                    </div>
                    <div class="box d-flex">
                        <div>
                            immagine
                        </div>
                        <div>titolo</div>
                        <div>prezzo</div>
                    </div>
                    <div class="box d-flex">
                        <div>
                            immagine
                        </div>
                        <div>titolo</div>
                        <div>prezzo</div>
                    </div>
                    <div class="box d-flex">
                        <div>
                            immagine
                        </div>
                        <div>titolo</div>
                        <div>prezzo</div>
                    </div>
                </div>
            </div>
            <!-- FINE COLONNA DESTRA -->
        </div>
    </div>


</template>

<script>
import JumboComp from './partials/JumboComp.vue';
import SearchbarComp from './partials/SearchbarComp.vue';

export default {
    name: 'HomeComp',
    components: { JumboComp, SearchbarComp }
}
</script>
<style lang="scss" scoped>
    .sx-cont{
        width: 30%;
        min-height: 100vh;
        background-color: red;
    }


    .dx-cont{
        flex-direction: column;
        align-items: center;
        margin: 0 auto;
        width: 70%;
        min-height: 100vh;
        background-color: green;
    }.img-sec{
        flex-wrap: wrap;
    }.box{
        width: calc(70% / 3);
        height: 250px;
        margin: 15px;
        background-color: red;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>
