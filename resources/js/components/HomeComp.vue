<template>
    <div>
        <JumboComp />
        <div class="container">

            <h2 class="text-center mb-5">Cerca offerte su hotel, ville e tanto altro...</h2>
            <h3 class="text-center ">Inizia la tua ricerca da una città</h3>

            <SearchbarComp />

        </div>
        <div class="content mt-5 d-flex">

            <!-- INIZIO COLONNA  -->
            <div class="dx-cont d-flex">

                <h3 class="py-3">Appartamenti consigliati</h3>
                <!-- SEZIONE IMG PRIMO PIANO -->
                <div class="img-sec d-flex ">
                    <div v-for="dwelling in sponsoredDwellings" :key="`sponsorizzati-${dwelling.id}`">

                        <DwellingcardComp :apartment="dwelling" :categories="categories"/>

                    </div>

                </div>
                <!-- FINE SEZIONE IMG PRIMO PIANO -->
                <!-- <h3 class="py-3">Nuove offerte</h3>
                <div class="img-sec d-flex">

                    <div v-for="dwelling in sponsoredDwellings" :key="`Offerte-${dwelling.id}`">

                        <DwellingcardComp :apartment="dwelling" :categories="categories"/>

                    </div>

                </div> -->

            </div>
            <!-- FINE COLONNA  -->

            <div class="section d-flex align-items-center">
                <div class="w-100">
                    <h3 class="h3-margin text-center py-2">Le mete preferite dagli utenti</h3>
                    <div class="d-flex justify-content-center">
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Milano" @click="getValue('milano')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Roma" @click="getValue('roma')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Bali" @click="getValue('Bali, Rajasthan')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Tanzania" @click="getValue('Tanzânia')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Buenos Aires" @click="getValue('buenos-aires')"></router-link>
                        </div>
                        <!-- prima riga -->
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Cape Town" @click="getValue('cape-town')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Palm Springs" @click="getValue('palm-springs')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Utah" @click="getValue('Sevier School District, Utah, Stati Uniti')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Mauritius" @click="getValue('mauritius')"></router-link>
                        </div>
                        <div class="xs-box">
                            <router-link :to="{name:'search-results' , params:{city: city}}" class="search-link"><input type="button" class="search-input" id="city-top" value="Florida" @click="getValue('Westville, FL, ')"></router-link>
                        </div>
                        <!-- seconda riga -->
                    </div>
                </div>

            </div>
            <div class="section out">
                    <h3 class="text-center py-2">Trova ispirazione per i tuoi prossimi viaggi!</h3>
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
import DwellingcardComp from './partials/DwellingcardComp.vue';


export default {
    name: 'HomeComp',
    components: {
        JumboComp,
        SearchbarComp,
        FooterComp,
        DwellingcardComp
    },
    data(){
        return{
            apiUrl: '/api/dwellings',
            sponsoredDwellings: [],
            categories: '',
            city: ''

        }
    },

    methods:{

        getSponsoredDwellings(){

            axios.get(this.apiUrl + '/sponsored-dwellings')
            .then(r =>{
                this.sponsoredDwellings = r.data.dwellings;
                this.categories = r.data.categories;
            })

        },

        // PRENDE IL VALORE AL CLICK DEL PULSANTE
        getValue(value){
            let city_top = value.replaceAll(' ' , '-').toLowerCase();
            this.city = city_top;
            console.log(this.city_top);
            console.log(this.city);
            this.$emit('searchDwelling', this.city);
        }

    },
    created(){
        this.getSponsoredDwellings();
    }
}
</script>
<style lang="scss" scoped>

.search-input{
    all: unset;
    cursor: pointer;
}
.search-link{
    all: unset;
    cursor: pointer;
}
.h3-margin{
    margin-left: 3.5%;
}
.content{
    flex-direction: column;
    margin-bottom: 80px;

}
    .dx-cont{
        flex-direction: column;
        align-items: center;
        margin: 0 auto;
        width: 90%;
        min-height: 50vh;
        // background-color: #b3b3b3;
        margin-bottom: 50px;
    }.img-sec{
        flex-wrap: wrap;
        max-width: 100%;
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
        transition: 1s;
    }.box:hover{
        color: black;
    }
    .box-col{
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

        color: black;
    }
    .xs-box{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        color: black;
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
