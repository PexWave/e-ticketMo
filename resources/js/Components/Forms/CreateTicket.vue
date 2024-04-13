<template>
    <Sidebar />
    <v-layout>
        <v-col cols="3" class="px-10 py-10 mt-20">
            <!--ignore this -->
        </v-col>
        <v-col>
            <v-form class="px-10 py-10 mx-10 my-10">
                <h5>Office</h5>
                <v-text-field
                    id="text-field"
                    v-model="officeId"
                    :value="office.name"
                    variant="solo"
                    readonly
                />

                <h5>Client Type</h5>
                <!-- <v-select
                    label="Task"
                    :items="clientTypes"
                    item-value="id"
                    v-model="selectedClientTypeId"
                ></v-select> -->

                <select
                    id="client"
                    v-model="selectedClientTypeId"
                    class="input-box transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm border border-gray-300 hover:border-gray-400 px-3 py-2"
                    placeholder="Select a Client"
                >
                    <option
                        v-for="client in clientTypes"
                        :key="client.id"
                        :value="client.id"
                        class="py-2"
                    >
                        {{ client.name }}
                    </option>
                </select>

                <br /><br />
                <h5>Task</h5>

                <!-- <v-select
                    label="Task"
                    variant="solo"
                    :items="[
                        'Monitor repair',
                        'OS Installation',
                        'Server Maintenance',
                    ]"
                ></v-select> -->

                <select
                    id="taskType"
                    v-model="selectedTaskTypeId"
                    class="input-box transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm border border-gray-300 hover:border-gray-400 px-3 py-2"
                    placeholder="Select a Task type"
                >
                    <option
                        v-for="taskType in taskTypes"
                        :key="taskType.id"
                        :value="taskType.id"
                        class="py-2"
                    >
                        {{ taskType.task }}
                    </option>
                </select>

                <br /><br />
                <h5>Remarks</h5>
                <v-text-field
                    v-model="remarksInput"
                    class="remarks-field"
                    id="text-field"
                    label="Remarks"
                    variant="solo"
                >
                </v-text-field>

                <v-row justify="end">
                    <v-col cols="2">
                        <v-btn rounded class="w-100" id="v-btn">Cancel</v-btn>
                    </v-col>
                    <v-col cols="2">
                        <v-btn
                            rounded
                            class="w-100"
                            id="v-btn-prio"
                            @click="createTicket"
                            >Create</v-btn
                        >
                    </v-col>
                </v-row>
            </v-form>
        </v-col>
    </v-layout>
    <!-- <Footer /> -->
</template>

<script>
import Footer from "@/Components/Layout/Footer.vue";
import Sidebar from "@/Components/Client/ClientSidebar.vue";

// import composables
import useOffice from "@/Composables/Offices";
import useClientTypes from "@/Composables/ClientTypes";
import useUserClientTypes from "@/Composables/UserClientType";
import useTaskTypes from "@/Composables/TaskType";
import useUsers from "@/Composables/Users";
import useTickets from "@/Composables/Tickets";

import { ref, reactive, onMounted } from "vue";

export default {
    setup() {
        const { storeTicket } = useTickets();
        const { user, getUser } = useUsers();
        const { userClientType } = useUserClientTypes();
        const { office, getOffice } = useOffice();
        const { taskTypes, getTaskTypes } = useTaskTypes();
        const { clientTypes, getClientTypes } = useClientTypes();

        const officeId = ref(null);
        const selectedClientTypeId = ref(null);
        const selectedTaskTypeId = ref(null);
        const remarksInput = ref(null);

        const userId = 1;

        onMounted(async () => {
            try {
                await getUser(userId).then(async () => {
                    getOffice(user.value.office_id);
                    officeId.value = user.value.office_id;
                    await getClientTypes(officeId.value).then(() => {
                        console.log(clientTypes);
                    });
                    await getTaskTypes();
                });
            } catch (error) {
                console.error("Failed to fetch offices:", error);
            }
        });

        const createTicket = async () => {
            let ticketData = {
                user_id: userId, // to be changed later to userClientType.value
                client_type_id: selectedClientTypeId.value,
                task_type_id: selectedTaskTypeId.value,
                ticket_status: "Pending",
                actual_response: null,
                actual_resolve: null,
                remarks: remarksInput.value,
                modified_date: new Date().toISOString().slice(0, 16),
                reference_date: new Date().toISOString().slice(0, 16),
            };
            try {
                await storeTicket(ticketData);
            } catch (error) {
                console.error("Error creating ticket:", error);
            }
        };

        return {
            office,
            clientTypes,
            taskTypes,
            officeId,
            selectedClientTypeId,
            selectedTaskTypeId,
            remarksInput,
            createTicket,
        };
    },

    components: {
        Footer,
        Sidebar,
    },
};
</script>
