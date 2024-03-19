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
        label= "Office"
        readonly
>
    </v-text-field>

    <h5> Client Type </h5>
    <v-select
    label= "Client Type"
    variant="solo"
    outlined
    :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
    >
    </v-select>

    <h5> Task </h5>
    <v-select
    label= "Task"
    variant="solo"
    :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
    ></v-select>

    <h5> Remarks </h5>
    <v-text-field
            v-model="Remarks"
            class="remarks-field"
            id="text-field"
            label= "Remarks"
            variant="solo"
          >
    </v-text-field>

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
import Sidebar from '@/Components/Client/ClientSidebar.vue'; 


export default {
  components: {
    Footer,
    Sidebar
  }
}
</script>