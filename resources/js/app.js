require("./bootstrap");

import { createApp } from "@vue/runtime-dom";
import router from "./router";
import App from "./App.vue";
import store from "./store";

// for Vue devtools chrome
createApp(App).config.performance = true;

createApp(App).use(store).use(router).mount("#app");
