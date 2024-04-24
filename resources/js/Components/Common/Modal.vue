<template>
    <v-dialog content-class="transfer-ticket-container">
      <template v-slot:activator="{ props: activatorProps }">
        <v-btn
          v-bind="activatorProps"
          color="surface-variant"
          text="Open Dialog"
          variant="flat"
        ></v-btn>
      </template>
    
      <template v-slot:default="{ isActive }">
        <v-card>
    
        <i class="fa fa-2xl cursor-pointer fa-times close-btn" text="Close Dialog"
            @click="isActive.value = false" aria-hidden="true"></i>
    
    
          <v-card-actions>
            <v-spacer></v-spacer>
    
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
    </template>