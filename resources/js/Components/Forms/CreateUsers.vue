<template>
<Sidebar />
<v-layout>
<v-col cols=3 class="px-10 py-10 mt-20">
    <!--ignore this -->
</v-col>

<v-col>
<v-form class="px-10 py-10 mx-10 my-10">

    <v-row>

    <v-col cols=4 align="center" justify="center">
        <img src="images/image.png">
        <v-btn rounded class="w-50" id="v-btn-prio">Upload</v-btn>
    </v-col>

    <v-col cols= 8>
    <h5> First Name </h5>
    <v-text-field
        id="text-field"
        variant="solo"
        label = "Enter first name"    
    ></v-text-field>

    <h5> Middle Name </h5>
    <v-text-field
        id="text-field"
        variant="solo"
        label = "Enter middle name"    
    ></v-text-field>
    
        <h5> Last Name </h5>
    <v-text-field
        id="text-field"
        variant="solo"
        label = "Enter last name"    
    ></v-text-field>
    </v-col>
    </v-row>

    <v-row>
    <v-col>
    <h5> Username </h5>
    <v-text-field
        id="text-field"
        variant="solo"
        label = "Enter username"    
    ></v-text-field>
    </v-col>
    
    <v-col>
    <h5> Password </h5>
    <v-text-field
        id="text-field"
        variant="solo"
        label = "Enter Password"    
    ></v-text-field>
    </v-col>
    

    </v-row>
  
    
    <v-row>
    <v-col>
    <h5> User Type </h5>
    <v-select
    variant="solo"
    :items="['Client', 'Help Desk', 'CSD Staff', 'Supervisor']"
    ></v-select>
    </v-col>
    </v-row>

    <v-row justify="end">
    <v-col cols=2>
    <v-btn rounded class="w-100" id="v-btn">Cancel</v-btn>
    </v-col>
    <v-col cols=2>
    <v-btn rounded class="w-100" id="v-btn-prio">Create</v-btn>
    </v-col>
    </v-row>

</v-form>
</v-col>
</v-layout>
<Footer />


</template>

<script>
import Footer from '@/Components/Layout/Footer.vue'; 
import Sidebar from '@/Components/Supervisor/SupervisorSidebar.vue'; 


export default {
  components: {
    Footer,
    Sidebar
  }
}
</script>