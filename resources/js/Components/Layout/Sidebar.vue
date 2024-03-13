<template>
 <v-layout>
  <v-navigation-drawer app class="sidebar" width="250">
      <v-list class="px-5 py-20">

        <v-list-item link>
          <v-list-item-content>
            <img src="images/LETTERMARK.png" class="drawer-logo">
           </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content class="text-icon">
            <v-icon icon="fas fa-home" size="20px" class="drawer-icon"/>
            Home
           </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content class="text-icon">
            <v-icon icon="fas fa-briefcase" size="20px" class="drawer-icon"/>
          Offices
          </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content class="text-icon">
            <v-icon icon="fas fa-folder-open" size="20px" class="drawer-icon"/>
            Tasks
          </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content class="text-icon">
            <v-icon icon="fas fa-users" size="20px" class="drawer-icon"/>
            Users
          </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content class="text-icon">
           <v-icon icon="fas fa-circle-info" size="20px" class="drawer-icon"/>
            About
          </v-list-item-content>
        </v-list-item>


      </v-list>
    </v-navigation-drawer>

 </v-layout>
</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css'
import { createVuetify } from 'vuetify'
import { aliases, fa } from 'vuetify/iconsets/fa'

export default createVuetify({
  icons: {
    defaultSet: 'fa',
    aliases,
    sets: {
      fa,
    },
  },
})
</script>