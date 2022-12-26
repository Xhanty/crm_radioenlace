require("./bootstrap");

window.Vue = require("vue");

// Register our components
Vue.component("kanban-board", require("./components/KanbanBoard.vue").default);

// Register our components (in the next step)

const app = new Vue({
    el: "#app",
});
