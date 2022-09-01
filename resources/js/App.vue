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

}
</style>
