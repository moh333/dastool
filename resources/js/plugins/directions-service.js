//import * as GmapVue from 'gmap-vue'
//import DirectionsRenderer from '../components/calculator/DirectionsRenderer.js'

const defaultOptions = {
    debug: false,
}

class DirectionsService {

    constructor(debug = false) {
        this.debug = debug
        this.init()
    }

    init() {
        this.origin = {}
        this.destination = {}
        this.travelMode = 'DRIVING'
        this.waypoints = []
        this.result = {}
        this.directionsService = null
    }

    setOrigin(origin) {
        this.origin = origin
    }

    setDestination(destination) {
        this.destination = destination
    }

    setTravelMode(mode) {
        this.travelMode = mode
    }

    addWaypoint(waypoint) {
        this.waypoints.push(waypoint)
    }

    getDirection() {

        this.directionsService = new google.maps.DirectionsService

        const directionData = {
            origin: this.origin,
            destination: this.destination,
            waypoints: this.waypoints,
            travelMode: this.travelMode
        }

        return this.directionsService.route(directionData, (response, status) => {

            if (status === 'OK') {
                this.init()
            } else {
                Sentry.captureMessage('Directions request failed due to ' + status)
                this.init()
            }

        })

    }

}



export default function install (Vue, setupOptions = {}) {

    const options = Object.assign({}, defaultOptions, setupOptions)

    /*Vue.use(GmapVue, {
        load: {
            key: process.env.MIX_GOOGLE_MAPS_KEY,
            libraries: 'places', // This is required if you use the Autocomplete plugin
            // OR: libraries: 'places,drawing'
            // OR: libraries: 'places,drawing,visualization'
            // (as you require)

            //// If you want to set the version, you can do so:
            // v: '3.26',
        },

        //// If you intend to programmatically custom event listener code
        //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
        //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
        //// you might need to turn this on.
        // autobindAllEvents: false,

        //// If you want to manually install components, e.g.
        //// import {GmapMarker} from 'gmap-vue/src/components/marker'
        //// Vue.component('GmapMarker', GmapMarker)
        //// then set installComponents to 'false'.
        //// If you want to automatically install all the components this property must be set to 'true':
        installComponents: true
    })*/

    //Vue.component('DirectionsRenderer', DirectionsRenderer)

    Vue.prototype.$directionsService = new DirectionsService(options.debug)

}
