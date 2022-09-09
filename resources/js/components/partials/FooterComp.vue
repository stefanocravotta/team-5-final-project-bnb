<template>
  <div class="d-flex container" >
    <div class="top-row ">

    </div>
    <div class="ft-wrap">
        <div>
        <h3>Rimani connesso con noi:</h3>
        <div class="icon">
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-tiktok"></i></a>


        </div>
        </div>
        <!-- <div class="ft-col">
            <ul>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
            </ul>
        </div> -->
         <!-- <div class="ft-col">
            <ul>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
            </ul>
        </div> -->
         <div class="ft-col">
            <ul>
                <router-link :to="{name:'chi-siamo'}">Chi siamo</router-link>
                <li><a href="#">Termini di Servizio</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Note Legali</a></li>
                <li><a href="#">Metodi di pagamento</a></li>
                <li><a href="#">Contatti</a></li>
                <li><a href="#">Community</a></li>
            </ul>
        </div>


    </div>

    <div class="top-row"></div>

    <div class=" bottom d-flex bottom ">
        <div>
           Powered by Team 5
        </div>

    </div>

  </div>
</template>

<script>
export default {
    name: 'FooterComp',
}
</script>

<style lang="scss" scoped>
    .container{
        flex-direction: column;
        align-items: center;
        justify-content: center;
        .top-row{
            height: 0.5px;
            width: 95vw;
            margin-bottom: 20px;
            margin-top: 20px;
            background-color: white;
        }
        .ft-wrap{
            display: flex;
        }.ft-col{
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 250px;
            margin: 2px;
            // height: 40px;
            // background-color: red;
        }ul li{
            list-style: none;
        }.bottom{
            align-items: center;
        }.icon i{
            cursor: pointer;
            margin: 5px;
        }a{
            text-decoration: none;
            font-style: none;
            color: #beb7a4;
        }a:hover{
            font-style: italic;
        }
    }

</style>
