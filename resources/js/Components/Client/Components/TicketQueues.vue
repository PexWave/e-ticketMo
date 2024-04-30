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
    <v-card style='padding:24px'>

    <i class="fa fa-2xl cursor-pointer fa-times close-btn" text="Close Dialog"
        @click="isActive.value = false" aria-hidden="true"></i>

        <v-container
        fluid class="bg-transparent">
            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="6" align="start">
                    <v-sheet class="ma-2 pa-2">
                        <span>HOO1 | Repair a monitor</span>
                    </v-sheet>
                </v-col>
                <v-col cols="6" sm="6" align="end">
                    <v-sheet class="ma-2 pa-2">
                        <span>Assigned | 


                        </span>

                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>



        <v-container
        fluid class="bg-transparent">
            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="4">
                    <v-sheet class="ma-2 pa-2">
                        <p>SLA response time</p>

                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
                <v-col cols="6" sm="4">
                    <v-sheet class="ma-2 pa-2">
                        <p>Extension time</p>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
                <v-col cols="6" sm="4">
                    <v-sheet class="ma-2 pa-2">
                        <p>SLA response date time</p>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
            </v-row>


            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="4">
                    <v-sheet class="ma-2 pa-2">
                        <p>SLA resolve time</p>

                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
                <v-col cols="6" sm="4">
                    <v-sheet class="ma-2 pa-2">
                        <p>Extension time</p>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
                <v-col cols="6" sm="4">
                    <v-sheet class="ma-2 pa-2">
                        <p>SLA resolve date time</p>
                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="12">
                    <v-sheet class="ma-2 pa-2">
                        <p>Remarks</p>

                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="12">
                    <v-sheet class="ma-2 pa-2">
                        <p>Actual response date and time</p>

                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="12">
                    <v-sheet class="ma-2 pa-2">
                        <p>Actual resolve date and time</p>

                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="12">
                    <v-sheet class="ma-2 pa-2">
                        <p>Transfer status</p>

                        <v-text-field
                            id="text-field"
                            variant="solo"
                            label=""
                        ></v-text-field>
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row no-gutters justify="space-between">
                <v-col cols="6" sm="12">
                    <v-sheet align="end" class="ma-2 pa-2">
                        <v-btn>
                        Button
                        </v-btn>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>

      <v-card-actions>
        <v-spacer></v-spacer>
      </v-card-actions>
    </v-card>
  </template>
</v-dialog>
</template>
  <script>
    import "../../../../css/client.css";

    export default {
      data () {
        return {
 
        }
      },
    }
  </script>