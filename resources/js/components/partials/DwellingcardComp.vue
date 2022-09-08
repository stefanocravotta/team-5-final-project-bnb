<template>
    <div>
        <img class="w-100" v-if="apartment.image != null" :src="`/images/${apartment.image}`" :alt="apartment.name">
        <img class="w-100" v-else :src="`/images/villa-affitto-italia-ada-1624884100.jpg`">
        <div class="card-text">
            <div><strong>{{ apartment.name}}</strong></div>
            <div>{{ apartment.address }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DwellingcardComp',
    props: { apartment: Object }
}
</script>

<style lang="scss" scoped>
.card-text{
    padding: 5px;
}
</style>
