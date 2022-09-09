<template>
  <div>
    <h2>Chi siamo</h2>
        <div class="c-wrap d-flex">
            <div class="c-row d-flex"></div>
        </div>
    <div class="logo d-flex">
        <img src="images/logo/1.png" alt="">
    </div>
    <h2>Membri</h2>
    <div class="d-flex url-wrap">
        <div class="d-flex url">
            <i class="fa-solid fa-crown"></i>
            <div>
                <a href="https://github.com/agostinopique">Agostino Piqè</a>
            </div>
        </div>
        <div class="d-flex url">
            <i class="fa-solid fa-crown"></i>
            <div>
                <a href="https://github.com/davide1217">Davide Pizzola</a>
            </div>
        </div>
        <div class="d-flex url">
            <i class="fa-solid fa-crown"></i>
            <div>
                <a href="https://github.com/DavideManciucca">Davide Manciucca</a>
            </div>
        </div>
        <div class="d-flex url">
            <i class="fa-solid fa-crown"></i>
            <div>
                <a href="https://github.com/stefanocravotta">Stefano Cravotta</a>
            </div>
        </div>
        <div class="d-flex url">
            <i class="fa-solid fa-crown"></i>
            <div>
                <a href="https://github.com/MikeyBadi">Mihai Badia</a>
            </div>
        </div>


        <!-- <a href="https://github.com/davide1217">Davide Pizzola</a>
        <a href="https://github.com/DavideManciucca">Davide Manciucca</a>
        <a href="https://github.com/stefanocravotta">Stefano Cravotta</a>
        <a href="https://github.com/MikeyBadi">Mihai Badia</a> -->
    </div>
    <div class="c-wrap d-flex">
            <div class="c-row d-flex"></div>
        </div>
  </div>
</template>

<script>
export default {
    name:'ChiSiamoComp'
}
</script>

<style lang="scss" scoped>
.c-wrap{
    justify-content: center;
}
.c-row{
    width: 95%;
    height: 3px;
    background-color: white;
    margin-top: 8px;
    margin-bottom: 8px;
    border-radius: 5px;
    animation-name: linerow;
    animation-duration: 10s;
    // animation-iteration-count: infinite;
}
@keyframes linerow{
    0%{width: 0%; background-color: black;}
    50%{width: 95%; background-color: #707db1; transition: smooth;}
    // 100%{width:0%;}
}
h2{
    text-align: center;
    margin-bottom: 20px;
}
.logo{
    height: 400px;
    width: 400px;
    margin: 0 auto;
}.url-wrap{
    justify-content: center;
    font-size: 16px;
}.url-wrap a{
    margin-left: 25px;
    margin-right: 25px;
    text-decoration: none;
    transition: 1s;
}.url{
    flex-direction: column;
    align-items: center;
}
</style>
