<template>
   <v-container class="mx-0 my-0 px-0 py-0">
    <v-row>
      <!-- Logo Column -->
      <v-col cols="6" class="logo-col d-flex justify-center align-center w-screen">
        <img src="images/LOGO-BLUE.png" class="w-80">
      </v-col>

      <!-- Sign In Column -->
      <v-col cols="6" class="sign-in-col w-full">
      
        <v-form class="w-100">
        <h1 class="header text-center"> Sign In </h1>
          <v-text-field v-model="username" label="Username"></v-text-field>
          <v-text-field v-model="password" label="Password" type="password"></v-text-field>
          <v-btn class="w-100"color="primary" @click="signIn">Sign In</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

