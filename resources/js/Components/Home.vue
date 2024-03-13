<template>
    <Sidebar />
   <v-layout>
   
    <Footer />
   </v-layout>

</template>

<script>
import Footer from '@/Components/Layout/Footer.vue'; 
import Sidebar from '@/Components/Layout/Sidebar.vue'; 


export default {
  components: {
    Footer,
    Sidebar
  }
}
</script>