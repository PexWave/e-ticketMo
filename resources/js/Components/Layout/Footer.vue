<template>
    <v-footer class="footer mx-0 my-0 px-0 py-0" app fixed>
        <v-container class="footer">
            <v-layout row class="footer-content">
                <v-col cols="4" align-self="end" class="seal-column px-3">
                    <!-- Seal -->
                    <img src="images/SEAL.png" alt="Seal" class="w-100" />
                </v-col>

                <v-col cols="8" align-self="start" class="time-column py-5">
                    <h3>Philippine Standard Time</h3>
                    <span>{{ currentDate }} | </span
                    ><span>{{ currentTime }}</span>
                </v-col>
            </v-layout>
        </v-container>
    </v-footer>
</template>

<script>
export default {
    data() {
        return {
            currentTime: "",
            currentDate: "",
        };
    },
    mounted() {
        // Update current time and date every second
        setInterval(() => {
            this.currentTime = new Date().toLocaleTimeString();
            this.currentDate = new Date().toLocaleDateString();
        }, 1000);

        // Initial update
        this.updateTimeAndDate();
    },
    methods: {
        updateTimeAndDate() {
            this.currentTime = new Date().toLocaleTimeString();
            this.currentDate = new Date().toLocaleDateString();
        },
    },
};
</script>
