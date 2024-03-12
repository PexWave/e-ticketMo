<template>
   <v-container fluid class="my-0 mx-0 py-0 px-0">
    <v-layout row wrap>

     <v-flex xs12 md4 class="logo h-screen" >
      <img src="images/LOGO-BLUE.png" class="w-55 px-16">
     </v-flex>

    <v-flex xs12 md8 class="sign-in h-screen">
      <v-form class="w-50">
          <v-text-field v-model="username" label="Username"></v-text-field>
          <v-text-field v-model="password" label="Password" type="password"></v-text-field>
          <v-btn class="w-100"color="primary">Sign In</v-btn>
        </v-form>
        <Footer />
     </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Footer from '@/Components/Footer.vue'; 

export default {
  components: {
    Footer
  }
}
</script>