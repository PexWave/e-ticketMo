<template>
    <Sidebar />
    <v-layout>
        <v-col cols="3" class="px-10 py-10 mt-20">
            <!--ignore this -->
        </v-col>

        <v-col>
            <v-form class="px-10 py-10 mx-10 my-10">
                <v-row>
                    <v-col cols="4" align="center" justify="center">
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="Assigned to"
                        ></v-text-field>
                        >
                    </v-col>

                    <v-col cols="8">
                        <h5>Response: </h5>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="1 hour"
                        ></v-text-field>

                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <h5>Resolve</h5>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="Enter username"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <h5>Extension</h5>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="Enter username"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <h5>New Resolve</h5>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="Enter username"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <h5>Task Accomplished</h5>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="Enter username"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <h5>Remarks</h5>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label="Enter username"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row justify="end">
                    <v-col cols="2">
                        <v-btn rounded class="w-100" id="v-btn">Edit</v-btn>
                    </v-col>
                    <v-col cols="2">
                        <v-btn rounded class="w-100" id="v-btn-prio"
                            >Transfer</v-btn
                        >
                    </v-col>
                </v-row>
            </v-form>
        </v-col>
    </v-layout>
    <Footer />
</template>

<script>
import Footer from "@/Components/Layout/Footer.vue";
import Sidebar from "@/Components/Supervisor/SupervisorSidebar.vue";

export default {
    components: {
        Footer,
        Sidebar,
    },
};
</script>
