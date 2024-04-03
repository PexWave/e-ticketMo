<template>
    <Sidebar />
    <v-layout>
        <v-col cols="3" class="px-10 py-10 mt-20">
            <!-- Ignore this -->
        </v-col>

        <v-col cols="8" align="center" justify="center">
            <v-row class="px-5 py-10 mt-20">
                <h1>Offices</h1>
            </v-row>

            <v-row>
                <!-- Table here -->
                <v-data-table :headers="headers" :items="offices" item-key="id">
                    <template v-slot:item="{ item }">
                        <v-icon
                            small
                            @click="editItem(item)"
                            size="15px"
                            id="action-icon"
                            >fas fa-pencil</v-icon
                        >
                        <v-icon
                            small
                            @click="deleteItem(item)"
                            size="15px"
                            id="action-icon"
                            >fas fa-trash-alt</v-icon
                        >
                    </template>
                </v-data-table>
            </v-row>
        </v-col>

        <Footer />
    </v-layout>
</template>

<script>
import Footer from "@/Components/Layout/Footer.vue";
import Sidebar from "@/Components/Supervisor/SupervisorSidebar.vue";

export default {
    components: {
        Footer,
        Sidebar,
    },
    data() {
        return {
            headers: [
                { text: "Office", value: "office" },
                { text: "Actions", value: "actions", sortable: false },
            ],
            offices: [
                { id: 1, office: "City Treasurer Office" },
                { id: 2, office: "Computer Services Division" },
                // Add more office data as needed
            ],
        };
    },
    methods: {
        editItem(item) {
            // Handle edit action here
            console.log("Edit item:", item);
        },
        deleteItem(item) {
            // Handle delete action here
            console.log("Delete item:", item);
        },
    },
};
</script>
