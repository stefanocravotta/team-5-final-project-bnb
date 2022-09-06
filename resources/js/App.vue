<template>
    <div>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import HomeComp from './components/HomeComp.vue';

export default {
    name: "App",
    components: { HomeComp},
}
</script>

<style>
main{
    min-height: calc(100vh - 110px);
    /* background-color: black; */
    /* background-color: #ea7722; */
    background-color: black;
    /* color: white; */
    color: black;
}
</style>
