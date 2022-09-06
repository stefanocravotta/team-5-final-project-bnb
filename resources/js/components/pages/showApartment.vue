<template>
    <div class="">
        <!-- imgages -->
        <div class="container-fluid mb-imgPg">
            <div class="row mb-imgSection">
                <img v-if="apartment.image"
                class="mb-principalImg col-8"
                :src="`/images/${apartment.image}`" :alt="apartment.name">
                <img class="mb-principalImg col-8" v-else :src="`/images/villa-affitto-italia-ada-1624884100.jpg`">
                <div class="mb-containerSide col-4">
                    <img
                    class="mb-sideImg"
                    :src="'/images/8824717.jpg'" alt="">
                    <img
                    class="mb-sideImg"
                    :src="'/images/8824717.jpg'" alt="">
                    <div class="button button-2">Mostra più immagini</div>
                </div>
            </div>
        </div>

        <!-- content of the page -->
        <div class="mb-frontCont">
            <!-- propriety description -->
            <div class="container-fluid mb-proprietyDesc">
                <h1>{{apartment.name}}</h1>
                <p v-if="apartment.decription">{{apartment.description}}</p>
            </div>

            <!-- home info -->
            <div class="containter-fluid">
                <div class="row row-col row-cols-lg-5 d-flex mb-containerInfo">
                    <div class="mb-infoHome d-flex">
                        <h2>Categoria:</h2>
                        <h3>{{apartment.category}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Numero di stanze:</h2>
                        <h3>{{apartment.rooms}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Numero letti:</h2>
                        <h3>{{apartment.beds}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Numero bagni:</h2>
                        <h3>{{apartment.bathrooms}}</h3>
                    </div>
                    <div class=" mb-infoHome d-flex">
                        <h2>Dimensioni della proprietà:</h2>
                        <h3>{{apartment.dimentions}} mtq</h3>
                    </div>
                </div>
                    <div class="mb-positionInfo">
                        <div class="container-fluid">
                            <h2>Posizione</h2>
                            <h3>{{apartment.address}}</h3>
                        </div>
                        <div class="mb-mappa">
                            <p>Qui ci sarà la mappa giganterrima</p>
                        </div>
                    </div>
            </div>

            <!-- PERKS -->
            <div class="mb-services d-flex justify-content-between">
                <h3>Lista servizi</h3>
                <div class="mb-perks">
                    <div class="container">
                        <div class="row">

                            <div v-for="perk in apartmentPerks" :key="perk.id" class="col-4 mb-rowPerks">
                                <i>{{perk.icon}}</i>
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

                            <form @submit.prevent="sendMessage">

                                <div v-if="!isAuthenticated" class="mb-emailContact d-flex flex-column mt-3">
                                    <label for="email">Inserisci la tua email: </label>
                                    <input v-model="email" type="email" id="email" placeholder="Inserisci la tua mail">
                                </div>

                                <div class="mb-msgContact d-flex flex-column mt-3">
                                    <label for="content">Scrivi il tuo messaggio all'inserzionista: </label>
                                    <textarea v-model="text" type="text" name="email_content" id="content" placeholder="Scrivi il tuo messaggio"></textarea>
                                </div>

                                <div class="d-flex flex-column mt-3">
                                    <button type="submit" class="btn btn-success">
                                        {{ sending ? 'Invio in corso...' : 'Invia' }}
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
// import showApartment from '../showApartment.vue'
export default {
    name: 'ShowApartment',
    data(){
        return{
            apiUrl: '/api/dwellings',
            apartment: '',
            apartmentPerks:[],
            categories: [],
            category: '',
            sending: false,
            isAuthenticated: false,
            user: [],
            email: '',
            text:'',
            dwelling_id: ''
        }
    },

    methods:{

        sendMessage(){
            axios.post('api/save-message', {
                'email': this.email,
                'text': this.text,
                // 'dwelling_id': this.dwelling_id,
            })
            .then(r =>{
                console.log(r)
            })
        },

        getUser(){
            this.isAuthenticated = false;

            this.user = window.User;

            if(window.Checked){
                this.isAuthenticated = true;
            }

        },

        getDwelling(){

            axios.get(this.apiUrl + '/show-dwelling/' + this.$route.params.slug)
            .then(r =>{
                // console.log(r.data)
                this.apartment = r.data.dwelling;
                this.categories = r.data.categories;
                this.apartmentPerks = r.data.dwelling.perks;
                // console.log(this.apartmentPerks);
            })
            .catch((er) =>{
                console.log(er)
            })
            console.log(this.window);

            this.findCategory()
        },

        findCategory(){
            this.categories.forEach(el => {
                console.log(el)
            });
        }

    },
    mounted(){
        this.getDwelling()
        this.getUser()
    }
}
</script>

<style scoped lang="scss">
// template{
//     }
// .frontCont{
//     // position: absolute;
//     // z-index: 2;
//     // top: 100%;
// }
// sezione immagini
.mb-imgPg{
    background-color: rgb(187, 187, 187);
    padding-top: 40px;
    // height: 80%;
    // position: sticky;
    // top: 0;
    // z-index: -1;
    .mb-imgSection{
        overflow: scroll;
            img:hover{
                filter: brightness(80%);
            }
            // .mb-principalImg{
            //     // width: 68.2%;
            // }
            .mb-containerSide{
                // width: 31.8%;
                // margin-left: 2.7%;

                .mb-sideImg{
                    width: 77%;
                    margin-bottom: 10%;
                }


                // button show more
                .button {
                    width: 77%;
                    padding-top: 30px;
                    padding-bottom: 30px;
                    text-align: center;
                    color: #000;
                    text-transform: uppercase;
                    font-weight: 600;
                    cursor: pointer;
                    display: inline-block;
                }
                .button-2 {
                    color: #fff;
                    border: 3px solid #000000;
                    background-image: linear-gradient(30deg, #000000 50%, transparent 50%);
                    background-size: 300%;
                    background-repeat: no-repeat;
                    background-position: 0%;
                    transition: background 300ms ease-in-out;
                }
                .button-2:hover {
                    background-position: 100%;
                    color: #000000;
                }
            }
        }
}

// descrizione con titolo dell'abitazione + descrizione di 200parole
    .mb-proprietyDesc{
        background-color: rgb(187, 187, 187);
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
        background-color: rgb(187, 187, 187);
        margin: 0;
        .mb-infoHome{
            border: 1px solid #403829;
            border-bottom: 2px solid #403829;
            border-top: 2px solid #403829;
            // box-sizing: border-box;
            flex-grow: 1;
            width: 100%;
            height: 150px;
            overflow: scroll;
            flex-direction: column;

            h2{
                color: rgb(124, 124, 124);
                font-size: 16px;
                padding: 10px;
                align-self: start;
            }
            h3{
                word-wrap: break-word;
                text-align: center;
                margin: 0;
                align-self: center;
                justify-self: center;
            }
        }
        @media screen and (max-width: 992px) {
            .mb-infoHome{
                border-bottom: 1px solid #403829;
                border-top: 1px solid #403829;
            }
            .mb-infoHome:first-of-type{
                border-top:  2px solid #403829;
                border-left:  2px solid #403829;
            }
            .mb-infoHome:last-of-type{
                border-bottom:  2px solid #403829;
                border-right:  2px solid #403829;
            }
        }
    }

    // container della mappa
    .mb-positionInfo{
        background-color: rgb(187, 187, 187);
        width: 100%;
        border-bottom:  2px solid #403829;
        padding-top: 30px;
        .mb-mappa{
            background-color: rgb(173, 171, 145);
            width: 100%;
            height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px 0px 20px;
        }
    }

    // container perks
    .mb-services{
        background-color: rgb(187, 187, 187);
        padding: 80px 0;
        border-bottom:  2px solid #403829;
        h3{
            width: 25%;
            height: fit-content;
            margin-top: 10vh;
            color: rgb(124, 124, 124);
            padding: 12.5px 5px;
            border-top: 1px solid #403829;
            border-bottom: 1px solid #403829;
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
        background-color:rgb(187, 187, 187);
    }
    .mb-contactPng{
        background: black;
        // Arrow and Text
        .link {
            display: inline-flex;
            align-items: center;
            padding: 5px;
            text-decoration: none;
            transform: rotate(180deg);
            height: 54px;

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
            background: #596D28;
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
        background: #596D28;
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
        color: #596D28;
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
                color: #758F34;
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


</style>
