<template>
    <div class="">
        <!-- imgages -->
        <div class="container-fluid mb-imgPg">
            <div class="row w-100">

                <div class="col-6 mb-imgSection">
                    <img v-if="apartment[0].image"
                    class="mb-principalImg"
                    :src="`/images/${apartment[0].image}`" :alt="apartment[0].name">
                    <img class="mb-principalImg" v-else :src="`/images/villa-affitto-italia-ada-1624884100.jpg`">
                </div>

                <MapComp class="col-6" v-if="apartment != null" :apartments="apartment" :coordinates="coordinates" />

            </div>
        </div>

        <!-- content of the page -->
        <div class="mb-frontCont">
            <!-- propriety description -->
            <div class="container-fluid mb-proprietyDesc">
                <h1>{{apartment[0].name}}</h1>
                <p v-if="apartment[0].description">{{apartment[0].description}}</p>
            </div>

            <!-- home info -->
            <div class="containter-fluid">
                <div class="row row-col row-cols-lg-5 d-flex mb-containerInfo">
                    <div class="mb-infoHome d-flex">
                        <h2>Categoria:</h2>
                        <h3>{{category}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Numero di stanze:</h2>
                        <h3>{{apartment[0].rooms}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Numero letti:</h2>
                        <h3>{{apartment[0].beds}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Numero bagni:</h2>
                        <h3>{{apartment[0].bathrooms}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Dimensioni della proprietà:</h2>
                        <h3>{{apartment[0].dimentions}} mtq</h3>
                    </div>
                </div>
            </div>

            <!-- PERKS -->
            <div class="mb-services d-flex justify-content-between">
                <div class="mb-containerSide">
                    <h2>Servizi</h2>
                </div>
                <div class="mb-perks">
                    <div class="container">
                        <div class="row">

                            <div v-for="perk in apartmentPerks" :key="perk.id" class="col-4 mb-rowPerks">
                                <i v-html="perk.icon"></i>
                                <p>{{perk.name}}</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- contact ins -->
            <div class="mb-containerContact">
                <div class="container-fluid mb-contactPng">
                    <div class="row row-col row-cols-lg-2 mb-contactPng">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="link">
                                <span class="link__arrow">
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="link__line"></span>
                                <div class="wrapper d-flex align-items-center justify-content-center">
                                    <span class=" link__text">contatta l'inserzionista</span>
                                    <span class=" text_hover">contatta l'inserzionista</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-contactForm">

                            <h2 v-if="success" class="success">Messaggio inviato correttamente</h2>
                            <form @submit.prevent="sendMessage">

                                <div v-if="!isAuthenticated" class="mb-emailContact d-flex flex-column mt-3">
                                    <label for="email">Inserisci la tua email: </label>
                                    <input v-model="email" type="email" id="email" placeholder="Inserisci la tua mail">
                                    <p v-if="errors.email" class="mt-2 error">{{ errors.email[0] }}</p>
                                </div>

                                <div class="mb-msgContact d-flex flex-column mt-3">
                                    <label for="content">Scrivi il tuo messaggio all'inserzionista: </label>
                                    <textarea v-model="text" type="text" name="email_content" id="content" placeholder="Scrivi il tuo messaggio"></textarea>
                                    <p v-if="errors.text" class="mt-2 error">{{ errors.text[0] }}</p>
                                </div>

                                <div class="d-flex flex-column mt-3 mb-btnSub">
                                    <button type="submit" class="button button-2">
                                        <!-- <div class="button button-2"> -->
                                            {{ sending ? 'Invio in corso...' : 'Invia' }}
                                        <!-- </div> -->
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import MapComp from '../partials/MapComp.vue';
export default {
  components: { MapComp },
    name: 'ShowApartment',
    data(){
        return{
            apiUrl: '/api/dwellings',
            messageUrl: '/api/save-message',
            apartment: null,
            apartmentPerks:[],
            categories: null,
            category: '',
            sending: false,
            isAuthenticated: false,
            user: [],
            email: '',
            text:'',
            dwelling_id: '',
            errors:{
                text: null,
                email: null
            },
            success: false,
            coordinates: {
                lat: null,
                long: null
            }
        }
    },

    methods:{

        sendMessage(){
            console.log('Invio form...');
            this.success = false;

            axios.post(this.messageUrl, {
                'email': this.email,
                'text': this.text,
                'dwelling_id': this.dwelling_id,
            })
            .then(r =>{

                if(!r.data.success){
                    this.errors = r.data.errors;
                    console.log(this.errors)
                }else{
                    this.success = true;
                    this.errors = {},
                    this.email = '',
                    this.text = ''
                }
            })
            .catch((err) => {
                console.log('Oh oh, qualcosa é andato storto', err);
            })
        },

        getUser(){
            this.isAuthenticated = false;

            this.user = window.User;

            if(window.Checked){
                this.isAuthenticated = true;
                this.email = this.user.email;
            }

        },

        getDwelling(){

            axios.get(this.apiUrl + '/show-dwelling/' + this.$route.params.slug)
            .then(r =>{

                this.coordinates.lat = r.data.dwelling.lat;
                this.coordinates.long = r.data.dwelling.long;
                this.apartment = [r.data.dwelling];
                this.categories = r.data.categories;
                this.apartmentPerks = r.data.dwelling.perks;
                this.dwelling_id = r.data.dwelling.id;
                // console.log('risposta', r.data.dwelling);
                // console.log(this.apartment);
                this.findCategory()
            })
            .catch((er) =>{
                console.log(er)
            })




        },

        findCategory(){
            // console.log('funzione', this.categories);
            this.categories.forEach(el => {
                if(this.apartment[0].category == el.id){
                    this.category = el.name;
                }
            });
        }

    },
    mounted(){
        this.getDwelling();
        this.getUser();
    }
}
</script>

<style scoped lang="scss">
// sezione immagini

.mb-imgPg{
    background-color: #beb7a4;
    padding: 40px 0;
        display: flex;
        justify-content: center;
        align-content: center;

    // height: 80%;
    // position: sticky;
    // top: 0;
    // z-index: -1;
    .mb-imgSection{
        overflow: scroll;
        width: 100%;
        display: flex;
        justify-content: center;
        align-content: center;
            img{
                width: 90%;
                margin-left: 20px;
                border-radius: 3px;
            }
            img:hover{
                filter: brightness(80%);
            }
            // .mb-principalImg{
            //     // width: 68.2%;
            // }

        }
}               .button {
                    width: 100%;
                    // padding-top: 30px;
                    // padding-bottom: 30px;
                    // text-align: center;
                    color: #000;
                    text-transform: uppercase;
                    font-weight: 600;
                    display: inline-block;
                }
                .button-2 {
                    color: #fff;
                    border: 0;
                    background-image: linear-gradient(45deg, #000000 50%, transparent 50%);
                    background-size: 300%;
                    background-repeat: no-repeat;
                    background-position: 0%;
                    transition: background 300ms ease-in-out;
                }
                .button-2:hover {
                    // background-image: linear-gradient(60deg, #FFFFFF 50%, transparent 50%);
                    // border: 3px solid #FFFFFF;
                    background-position: 100%;
                    color: #000000;
                }
// descrizione con titolo dell'abitazione + descrizione di 200parole
    .mb-proprietyDesc{
        // background-color: rgb(187, 187, 187);
        margin-bottom: 10px;
        padding-bottom: 10px;
        h1{
            padding-top: 50px;
            font-size: 90px;
        }
        p{
            font-weight: bold;
            font-size: 16px;
            width: 70%;
            padding-bottom: 100px;
            margin-bottom: 0;
        }
        @media screen and (max-width: 465px){
            h1{
                font-size: 300%;
            }
            p{
                font-size: 70%;
                width: 100%;

            }
        }
    }

// container delle info
    .mb-containerInfo{
        // background-color: rgb(187, 187, 187);
        margin: 0;
        .mb-infoHome{
            border: 2px solid #7a9e9f;
            border-bottom: 2px solid #7a9e9f;
            border-top: 2px solid #7a9e9f;
            // box-sizing: border-box;
            flex-grow: 1;
            width: 100%;
            height: 150px;
            overflow: scroll;
            flex-direction: column;

            h2{
                color: rgb(124, 124, 124);
                font-size: 20px;
                padding: 10px;
                align-self: start;
            }
            h3{
                font-size: 35px;
                word-wrap: break-word;
                text-align: center;
                margin: 0;
                align-self: center;
                justify-self: center;
            }
        }
        @media screen and (max-width: 992px) {
            .mb-infoHome{
                border-bottom: 1px solid #7a9e9f;
                border-top: 1px solid #7a9e9f;
            }
            .mb-infoHome:first-of-type{
                border-top:  2px solid #7a9e9f;
                border-left:  2px solid #7a9e9f;
            }
            .mb-infoHome:last-of-type{
                border-bottom:  2px solid #7a9e9f;
                border-right:  2px solid #7a9e9f;
            }
        }
    }

    // container della mappa
    .mb-positionInfo{
        // background-color: rgb(187, 187, 187);
        width: 100%;
        border-bottom:  2px solid #7a9e9f;
        padding-top: 30px;
        & > div:first-child{
            width: 35%;
            height: 85vh;
            background-color: rgb(173, 171, 145);
            color: #292F36;
            margin: 30px 0px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            & > div{
                height: 45%;
                width: 60%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-top: 2px solid #292F36;
                border-bottom: 2px solid #292F36;
            }
        }
        #mapContainer{
            background-color: rgb(173, 171, 145);
            width: 65%;
            height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px 0px 20px;
        }
    }

    // container perks
    .mb-services{
        .mb-containerSide{
            width: 45%;
                // button show more
            }

        // background-color: rgb(187, 187, 187);
        padding: 80px 0;
        border-bottom:  2px solid #7a9e9f;
        h2{
            width: 184px;
            height: fit-content;
            margin-left: 30%;
            color: rgb(124, 124, 124);
            padding: 12.5px 5px;
            border-top: 2px solid #7a9e9f;
            border-bottom: 2px solid #7a9e9f;
            text-align: center;
        }
        .mb-perks{
            margin: 0 auto;
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            // background-color: khaki;
            .mb-rowPerks{
                padding-top: 12.5px;
                // border-bottom: 2px solid rgb(255, 103, 43);
                width: 80%;
                text-align: center;
                p{
                    display: inline;
                }
            }
        }
    }
    // Msgs for the insertionist
    .mb-containerContact{
        padding: 20px 0 0;
        // background-color:rgb(187, 187, 187);
    }
    .mb-contactPng{
        // background: black;
        // Arrow and Text
        .link {
            display: inline-flex;
            align-items: center;
            padding: 5px;
            text-decoration: none;
            transform: rotate(180deg);
            height: 54px;
            cursor:help;

        &__arrow {
            display: inline-flex;

        span {
        position: relative;
        width: 14px;
        height: 2px;
        border-radius: 2px;
        overflow: hidden;
        background: #ffffff;
        z-index: 2;

        &:nth-child(1) {
            transform-origin: left bottom;
            transform: rotate(45deg) translate3d(8px, -10px, 0);
        }

        &:nth-child(2) {
            transform-origin: left bottom;
            transform: rotate(-45deg);
        }

        &:after {
            content: '';
            display: block;
            position: absolute;
            left: 0;
            width: 0;
            height: 2px;
            background: #7a9e9f;
        }
    }
  }

    &__line {
        position: relative;
        margin-left: -14px;
        margin-right: 30px;
        width: 70px;
        height: 2px;
        background: #ffffff;
        overflow: hidden;
        z-index: 1;

        &:after {
            content: '';
        display: block;
        position: absolute;
        left: 80px;
        width: 70px;
        height: 2px;
        background: #7a9e9f;
        }
    }
        .wrapper {
        transform: rotate(180deg);
        position: relative;

        .link__text,
        .text_hover {
        font-size: 36px;
        font-weight: bold;
        color: #ffffff;
        text-transform: uppercase;

        }
        .text_hover {
        overflow: hidden;
        width: 0;
        position: absolute;
        left: 0;
        top: 0;
        color: #7a9e9f;
        transition: width .5s ease-in-out;
        white-space: nowrap;
        }
        }


    &:hover {
        .text_hover{
        width: 100%;
        }
        .link{
            &__line {
                &:after {
                animation: animation-line 1.5s forwards;
                }
            }

            &__arrow {
                span {
                    &:after {
                        animation: animation-arrow 1.5s forwards;
                        animation-delay: 1s;
                    }
                }
            }
        }
    }
        }
        @keyframes animation-line {
        0% {
            left: 130px;
        }

        100% {
            left: 0;
        }
        }

        @keyframes animation-arrow {
        0% {
            width: 0;
        }

        100% {
            width: 100%;
        }
        }

        // Form for sending messages
        .mb-contactForm{
            padding: 180px 30px;


            .mb-emailContact, .mb-msgContact{
                margin: 0 auto;
                color: #beb7a4;
                label{
                    font-size: 20px;
                }
            }
            #content{
                height: 200px;
                resize: none;
            }
        }
        @media screen and (max-width: 967px) {
            .mb-contactForm{
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
            }
            .link__arrow, .link__line{
                display: none;
            }
        }
    }

.mb-btnSub{
    height: 60px;

    button{
        height: 100%;

    }
}

.error{
    color: red;
    font-size: 14px;
}

.success{
    color: rgb(6, 148, 6);
}



</style>
