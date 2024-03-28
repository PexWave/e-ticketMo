<template>
<Sidebar />
<v-layout>
<v-col cols=3 class="px-10 py-10 mt-20">
    <!--ignore this -->
    </v-col>
<v-col>
<v-form class="px-10 py-10 mx-10 my-10">

    <h5> Office </h5>
    <v-text-field
        id="text-field"
        variant="solo"
        readonly
>
    </v-text-field>

    <h5> Client Type </h5>
    <v-select
    variant="solo"
    outlined
    :items="['CTO-Collector', 'City-Planning']"
    >
    </v-select>

    <h5> Urgency </h5>
    <v-select
    variant="solo"
    :items="['1', '2', '3', '4', '5']"
    ></v-select>

    <h5> Difficulty </h5>
    <v-select
    variant="solo"
    :items="['1', '2', '3', '4', '5']"
    ></v-select>

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