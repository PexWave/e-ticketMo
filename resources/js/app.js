import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import router from "@/Router/index";

import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const vuetify = createVuetify({
    components,
    directives,
});

createApp().use(router).use(vuetify).mount("#app");
