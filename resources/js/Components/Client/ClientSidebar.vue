<template>
 <v-layout>
  <v-navigation-drawer app class="sidebar" width="300">
      <v-list class="sidebar px-8 py-30">

        <v-list-item link>
              <v-list-item-content>
                <img src="images/LETTERMARK.png" class="drawer-logo">
              </v-list-item-content>
        </v-list-item>

        <v-hover>
          <template v-slot:default="{ isHovering, props }">
          <a href="/client-home"> 
            <v-list-item link :class="{ 'blue-hover': isHovering }" v-bind="props">
              <v-list-item-content class="text-icon">
                <v-icon icon="fas fa-home" size="20px" class="drawer-icon"/>
                Home
              </v-list-item-content>
            </v-list-item>
          </a>
          </template>
        </v-hover>

        <v-hover>
          <template v-slot:default="{ isHovering, props }">
          <a href="/createTicket"> 
            <v-list-item link :class="{ 'blue-hover': isHovering }" v-bind="props">
              <v-list-item-content class="text-icon">
                <v-icon icon="fas fa-ticket" size="20px" class="drawer-icon"/>
                Create a Ticket
              </v-list-item-content>
            </v-list-item>
          </a>
          </template>
        </v-hover>

        
        <v-hover>
          <template v-slot:default="{ isHovering, props }">
            <v-list-item link :class="{ 'blue-hover': isHovering }" v-bind="props">
              <v-list-item-content class="text-icon">
                <v-icon icon="fas fa-circle-info" size="20px" class="drawer-icon"/>
                About
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-hover>
        
      </v-list>
    </v-navigation-drawer>

 </v-layout>
</template>

<style scoped>
.blue-hover {
  background-color: #F4F5FF;
  color: #263D8F;
  border-radius: 25px;
}
</style>

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