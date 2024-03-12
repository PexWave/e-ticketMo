<template>
  <v-footer class="footer mx-0 my-0 px-0 py-0" app fixed>
    <v-container class="footer"> 
      <v-layout row>
    
        <v-col align-self="end">
        <!-- Seal -->
          <img src="images/SEAL.png" alt="Seal" class="w-50">

        </v-col>

        <v-col align-self="end">
          <h3>Philippine Standard Time</h3>
          <span>{{ currentDate }} | </span><span>{{ currentTime }}</span>
        </v-col>


      </v-layout>
    </v-container>
  </v-footer>
</template>

<script>
export default {
  data() {
    return {
      currentTime: '',
      currentDate: ''
    };
  },
  mounted() {
    // Update current time every second
    setInterval(() => {
      this.currentTime = new Date().toLocaleTimeString();
    }, 1000);

    // Update current date
    this.currentDate = new Date().toLocaleDateString();
  }
}
</script>


