<template>
    <div id="mapContainer">

        <div ref="mapRef" id="map"></div>

    </div>
</template>

<script>
import {onMounted, reactive, ref } from 'vue';

export default {
    name: 'MapComp',

    props: {
        apartments: Array,
        coordinates: Object,
        range: String
    },

    setup(props) {

        let Zoom = 0;
        if (parseInt(props.range) > 10 ) {

            Zoom = 10;
        }
        else {

            Zoom = 11;
        }
        const mapRef = ref(null)

         onMounted(() => {
            const tt = window.tt;
            const focus = { lat: props.coordinates.lat, lng: props.coordinates.long }

            var map = tt.map({
                key: 'sXZ074rJ8QHr7ocOwfW5NaIHLwTog1tx',
                container: mapRef.value,
                center: focus,
                zoom: Zoom
            })

            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());

            window.map = map

            insertLocs(map)
        })

        const state = reactive({
            locations: []
        })

        props.apartments.forEach(apartment => {
            state.locations.push({ lat: apartment.lat, lng: apartment.long });
        });

        const insertLocs = (map) => {
            const tomtom = window.tt;
            state.locations.forEach(function (location, index) {
                var marker = new tomtom.Marker().setLngLat(location).addTo(map)
                const popup = new tt.Popup({ anchor: 'top' }).setText(props.apartments[index].name+', '+props.apartments[index].price+'€')
                marker.setPopup(popup).togglePopup()
            })
        }
        return {
            mapRef
        }
    },

    methods: {
        setStyles() {

            const domCatcher = setTimeout(() => {

                let popups = document.querySelectorAll('.mapboxgl-popup-content');
                popups.forEach(popup => {
                    popup.setAttribute('style','color: black; padding: 10px 10px 3px;');
                });
                let closeButtons = document.querySelectorAll('.mapboxgl-popup-close-button');
                closeButtons.forEach(button => {
                    button.setAttribute('style','transform: translate(0, -25%)')
                });
            }, 100);

        }
    },

    mounted() {
        this.setStyles();
    }

}
</script>
<style lang="scss" scoped>
#map {
    height: 78vh;
    width: 54vw;
    border-radius: 5px;
}
</style>
