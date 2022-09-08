<template>
    <div>
        <JumboComp />
        <div class="container">
            <h4>Cerca offerte su hotel, ville e tanto altro...</h4>

            <SearchbarComp />

        </div>
        <div class="content d-flex">

            <!-- INIZIO COLONNA  -->
            <div class="dx-cont d-flex">

                <h3>Appartamenti consigliati</h3>
                <!-- SEZIONE IMG PRIMO PIANO -->
                <div class="img-sec d-flex ">
                    <div v-for="dwelling in sponsoredDwellings" :key="`sponsorizzati-${dwelling.id}`" class="box d-flex">
                        <div class="dwelling_img">
                            <img class="w-100" v-if="dwelling.image != null" :src="`/images/${dwelling.image}`" :alt="dwelling.name">
                            <img class="w-100" v-else :src="`/images/villa-affitto-italia-ada-1624884100.jpg`">
                        </div>
                        <div>
                            <h4>{{dwelling.name}}</h4>
                        </div>
                        <div>
                            <p>{{dwelling.price}} €</p>
                        </div>
                    </div>

                </div>
                <!-- FINE SEZIONE IMG PRIMO PIANO -->
                <h3>Nuove offerte</h3>
                <div class="img-sec d-flex">

                    <div v-for="dwelling in sponsoredDwellings" :key="`Offerte-${dwelling.id}`" class="box d-flex">
                        <div class="dwelling_img">
                            <img class="w-100" v-if="dwelling.image != null" :src="`/images/${dwelling.image}`" :alt="dwelling.name">
                            <img class="w-100" v-else :src="`/images/villa-affitto-italia-ada-1624884100.jpg`">
                        </div>
                        <div>
                            <h4>{{dwelling.name}}</h4>
                        </div>
                        <div>
                            <p>{{dwelling.price}} €</p>
                        </div>
                    </div>

                </div>

            </div>
            <!-- FINE COLONNA  -->
            <div class="section d-flex">

                <h3>Viaggia di più e spendi di meno con...</h3>
                <div class="d-flex">
                    <div class="sm-box ">
                        <p>Genius</p>
                        <p>Approfitta degli sconti, viaggia ora</p>
                    </div>
                    <div class="sm-box ">
                        <p>Sconti del 10%</p>
                        <p>Approfitta degli sconti, viaggia ora</p>
                    </div>
                    <div class="sm-box ">
                        <p>Sconti del 15%</p>
                        <p>Approfitta degli sconti, viaggia ora</p>
                    </div>
                    <div class="sm-box ">
                        <p>Sconti de 30%</p>
                        <p>Approfitta degli sconti, viaggia ora</p>
                    </div>
                </div>
            </div>

            <div class="section">
                    <h3>Le mete preferite dagli utenti</h3>
                    <div class="d-flex">
                        <div class="xs-box">Sicilia</div>
                        <div class="xs-box">Val di Fassa</div>
                        <div class="xs-box">Cinque Terre</div>
                        <div class="xs-box">Liguria</div>
                        <div class="xs-box">Lago di Como</div>
                        <!-- prima riga -->
                    </div>
                    <div class="d-flex">
                        <div class="xs-box">Isola d'Elba</div>
                        <div class="xs-box">Toscana</div>
                        <div class="xs-box">Isola del Giglio</div>
                        <div class="xs-box">Lago di Garda</div>
                        <div class="xs-box">Argentario</div>
                        <!-- seconda riga -->
                    </div>
                    <div class="d-flex">
                        <div class="xs-box">Ibiza</div>
                        <div class="xs-box">Costiera Amalfitana</div>
                        <div class="xs-box">Puglia</div>
                        <div class="xs-box">Isole Tremiti</div>
                        <div class="xs-box">Sardegna</div>
                        <!-- terza riga -->
                    </div>
                    <div class="d-flex">
                        <div class="xs-box">Salento</div>
                        <div class="xs-box">Isole di Ischia</div>
                        <div class="xs-box">Isole di Lipari</div>
                        <div class="xs-box">Valle d'Aosta</div>
                        <div class="xs-box">Isola di Capri</div>
                        <!-- quarta riga -->
                    </div>
            </div>
            <div class="section out">
                    <h3>Trova ispirazione per i tuoi prossimi viaggi!</h3>
                    <div class="row">
                        <div class="col-md-4 col-xs-6 box-col d-flex ">
                            <img class="image" src="images/america.jpeg" alt="">
                            <div class="description">
                                <h6>Città americane da visitare</h6>
                                <p>Saluta l'estate senza rimpianti in una di queste città</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6 box-col d-flex">
                            <img class="image" src="images/spagna.jpg" >
                            <div class="description ">
                                <h6>6 mete ideali per un periodo sabbatico in Spagna</h6>
                                <p>Dimentica il lavoro per un po' e goditi un soggiorno lungo in terra spagnola</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6 box-col d-flex">
                            <img class="image" src="images/lasvegas.jpg" alt="">
                            <div class="description">
                                <h6>Cosa fare in 48 ore a Las Vegas</h6>
                                <p>Un itinerario di due giorni con <br> poco gioco d'azzardo e tanto divertimento</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
<div>
    <FooterComp />
</div>
    </div>

</template>

<script>
import JumboComp from './partials/JumboComp.vue';
import SearchbarComp from './partials/SearchbarComp.vue';
import FooterComp from './partials/FooterComp.vue';


export default {
    name: 'HomeComp',
    components: {
        JumboComp,
        SearchbarComp,
        FooterComp,
    },
    data(){
        return{
            apiUrl: '/api/dwellings',
            sponsoredDwellings: [],

        }
    },

    methods:{

        getSponsoredDwellings(){

            axios.get(this.apiUrl + '/sponsored-dwellings')
            .then(r =>{
                this.sponsoredDwellings = r.data.random_dwellings;
            })

        }

    },
    created(){
        this.getSponsoredDwellings();
    }
}
</script>
<style lang="scss" scoped>
.content{
    flex-direction: column;
    margin-bottom: 80px;

}
    .dx-cont{
        flex-direction: column;
        align-items: center;
        margin: 0 auto;
        width: 90%;
        min-height: 100vh;
        // background-color: #b3b3b3;
        margin-bottom: 50px;
    }.img-sec{
        flex-wrap: wrap;
        width: 100%;
        // align-items: center;
        justify-content: center;
    }.box{
        width: calc(90% / 3);
        min-height: 250px;
        margin: 15px;
        background-color: #FAFAFA;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }.box-col{
        // background-color: #FAFAFA;
        height: 300px;
        transition: 1s;
        flex-direction: column;
        align-items: center;
        justify-content: end;
    }.box-col:hover{
        transform: scale(1.05);
    }
    .image{
        position: absolute;
        height: 100%;
        width: 95%;
        transition: 1s;
    }.image:hover{
        filter:grayscale(60%);
        cursor: pointer;
    }
    .description{
        position: relative;
        text-align: center;
        align-items: center;
        color: black;
        padding: 7px;
        border-radius: 20px;
        background-color: rgba(245, 242, 244, 0.8);
        opacity: 0.8;
    }
    .section{
        flex-direction: column;
        margin-bottom: 50px;
    }.sm-box{
        // height: 90px;
        width: calc(90%/4);
        background-color: #FAFAFA;
        margin: 5px;
        padding: 10px;
        transition: 0.5s;
        cursor: pointer;
    }
    .sm-box:hover{
        background-color: skyblue;
    }
    .xs-box{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: calc(90%/5);
        background-color: #FAFAFA;
        margin: 5px;
        padding: 10px;
        transition: 0.5s;
        cursor: pointer;
    }
    .xs-box:hover{
        border-radius: 20px;
        color: orange;
    }
    .out{
        margin: 0 auto;
        max-width: 95vw;
    }
</style>
