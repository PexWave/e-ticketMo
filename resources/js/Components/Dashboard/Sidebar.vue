<template>
    <v-layout>
        <v-navigation-drawer app class="sidebar" width="300">
            <v-list class="px-8 py-30">
                <v-list-item link>
                    <v-list-item-content>
                        <img src="images/LETTERMARK.png" class="drawer-logo" />
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    style="margin: 1rem 0; border-radius: 1rem"
                    link
                    to="/dashboard"
                >
                    <v-list-item-content
                        style="font-size: 18px; margin: 0.5rem"
                        class="text-icon"
                    >
                        <v-icon size="20px" class="drawer-icon"
                            >fas fa-home</v-icon
                        >
                        Home
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    style="margin: 1rem 0; border-radius: 1rem"
                    link
                    to="/offices"
                >
                    <v-list-item-content
                        style="font-size: 18px; margin: 0.5rem"
                        class="text-icon"
                    >
                        <v-icon size="20px" class="drawer-icon"
                            >fas fa-briefcase</v-icon
                        >
                        Offices
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    style="margin: 1rem 0; border-radius: 1rem"
                    link
                    to="/offices"
                >
                    <v-list-item-content
                        style="font-size: 18px; margin: 0.5rem"
                        class="text-icon"
                    >
                        <v-icon size="20px" class="drawer-icon"
                            >fas fa-folder-open</v-icon
                        >
                        Tasks
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    style="margin: 1rem 0; border-radius: 1rem"
                    link
                    to="/offices"
                >
                    <v-list-item-content
                        style="font-size: 18px; margin: 0.5rem"
                        class="text-icon"
                    >
                        <v-icon size="20px" class="drawer-icon"
                            >fas fa-users</v-icon
                        >
                        Users
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    style="margin: 1rem 0; border-radius: 1rem"
                    link
                    to="/offices"
                >
                    <v-list-item-content
                        style="font-size: 18px; margin: 0.5rem"
                        class="text-icon"
                    >
                        <v-icon size="20px" class="drawer-icon"
                            >fas fa-info-circle</v-icon
                        >

                        About
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    style="margin: 1rem 0; border-radius: 1rem"
                    link
                    to="/offices"
                >
                    <v-list-item-content
                        style="font-size: 18px; margin: 0.5rem"
                        class="text-icon"
                    >
                        <v-icon size="20px" class="drawer-icon"
                            >fas fa-user</v-icon
                        >
                        Profile
                    </v-list-item-content>
                </v-list-item>

                <!-- Add other list items here -->
            </v-list>
        </v-navigation-drawer>
    </v-layout>
</template>

<script>
export default {
    name: "Sidebar",
};
</script>

<style scoped>
.blue-hover {
    background-color: #f4f5ff;
    color: #263d8f;
    border-radius: 20px;
}
</style>
