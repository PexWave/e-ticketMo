<template>
   <v-container fluid class="my-0 mx-0 py-0 px-0 h-screen">
    <v-layout row wrap>

     <v-flex xs12 md4 class="logo h-screen" >
      <img src="images/LOGO-BLUE.png" class="w-55 px-16">
     </v-flex>

    <v-flex xs12 md8 class="sign-in h-screen mb-16">
      <v-form class="w-50">
          <h1 class="py-5 text-center"> Sign In </h1>
          
          <v-text-field  rounded variant="solo" label="Username" id="v-text-field"></v-text-field>
          <v-text-field  rounded variant="solo" label="Password" type="password"></v-text-field>
          <v-btn rounded class="w-100" id="v-btn">Log In</v-btn>
        </v-form>
        <Footer />
     </v-flex>
    </v-layout>
  </v-container>
</template>

