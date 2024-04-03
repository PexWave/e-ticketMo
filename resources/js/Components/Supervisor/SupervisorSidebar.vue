<template>
    <v-layout>
        <v-navigation-drawer app class="sidebar" width="300">
            <v-list class="px-8 py-30">
                <v-list-item link>
                    <v-list-item-content>
                        <img src="images/LETTERMARK.png" class="drawer-logo" />
                    </v-list-item-content>
                </v-list-item>

                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <a href="/supervisor-dashboard">
                            <v-list-item
                                link
                                :class="{ 'blue-hover': isHovering }"
                                v-bind="props"
                            >
                                <v-list-item-content class="text-icon">
                                    <v-icon
                                        icon="fas fa-home"
                                        size="20px"
                                        class="drawer-icon"
                                    />
                                    Home
                                </v-list-item-content>
                            </v-list-item>
                        </a>
                    </template>
                </v-hover>

                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <a href="offices">
                            <v-list-item
                                link
                                :class="{ 'blue-hover': isHovering }"
                                v-bind="props"
                            >
                                <v-list-item-content class="text-icon">
                                    <v-icon
                                        icon="fas fa-briefcase"
                                        size="20px"
                                        class="drawer-icon"
                                    />
                                    Offices
                                </v-list-item-content>
                            </v-list-item>
                        </a>
                    </template>
                </v-hover>

                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <v-list-item
                            link
                            :class="{ 'blue-hover': isHovering }"
                            v-bind="props"
                        >
                            <v-list-item-content class="text-icon">
                                <v-icon
                                    icon="fas fa-folder-open"
                                    size="20px"
                                    class="drawer-icon"
                                />
                                Tasks
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-hover>

                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <v-list-item
                            link
                            :class="{ 'blue-hover': isHovering }"
                            v-bind="props"
                        >
                            <v-list-item-content class="text-icon">
                                <v-icon
                                    icon="fas fa-users"
                                    size="20px"
                                    class="drawer-icon"
                                />
                                Users
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-hover>

                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <v-list-item
                            link
                            :class="{ 'blue-hover': isHovering }"
                            v-bind="props"
                        >
                            <v-list-item-content class="text-icon">
                                <v-icon
                                    icon="fas fa-circle-info"
                                    size="20px"
                                    class="drawer-icon"
                                />
                                About
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-hover>

                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <v-list-item
                            link
                            :class="{ 'blue-hover': isHovering }"
                            v-bind="props"
                        >
                            <v-list-item-content class="text-icon">
                                <v-icon
                                    icon="fas fa-user"
                                    size="20px"
                                    class="drawer-icon"
                                />
                                Profile
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
    background-color: #f4f5ff;
    color: #263d8f;
    border-radius: 25px;
}
</style>

<script>
import "@fortawesome/fontawesome-free/css/all.css";
import { createVuetify } from "vuetify";
import { aliases, fa } from "vuetify/iconsets/fa";

export default createVuetify({
    icons: {
        defaultSet: "fa",
        aliases,
        sets: {
            fa,
        },
    },
});
</script>
