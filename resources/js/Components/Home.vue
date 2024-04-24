<template>
    <v-container class="flex items-center justify-center vh-100">
        <transition name="fade">
            <v-row v-if="!loading" class="flex-col relative">
                <v-img
                    :src="eticketImageUrl"
                    class="min-vh-50 min-vw-10"
                    alt="E-Ticket Image"
                ></v-img>
                <v-btn
                    @click="navigateToSignIn"
                    class="primary-bg white-color absolute bottom-0 right-2 px-10 py-2 rounded-full text-md"
                >
                    Sign In
                </v-btn>
            </v-row>
        </transition>
    </v-container>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";

import eticket from "../../../public/images/eticket.png";
import "../../css/global.css";

export default {
    setup() {
        const router = useRouter();
        const eticketImageUrl = ref(eticket);
        const loading = ref(true);

        const navigateToSignIn = () => {
            router.push({ name: "auth.signin" });
        };

        setTimeout(() => {
            loading.value = false;
        }, 1000);

        return {
            eticketImageUrl,
            navigateToSignIn,
            loading,
        };
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.7s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0;
}
</style>
