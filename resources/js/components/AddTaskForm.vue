<template>
    <form class="relative mb-3 flex flex-col justify-between bg-white rounded-md shadow overflow-hidden"
        @submit.prevent="handleAddNewTask">
        <div class="p-3 flex-1">
            <input class="block w-full px-2 py-1 text-lg border-b border-blue-800 rounded" type="text"
                placeholder="Introduce un título" v-model.trim="newTask.title" />
            <textarea class="mt-3 p-2 block w-full p-1 border text-sm rounded" rows="4"
                placeholder="Añade una descripción (opcional)" v-model.trim="newTask.description"></textarea>
            <!--<select class="mt-3 p-2 block w-full p-1 border text-sm rounded" v-model="newTask.user_id">
                <option value="" disabled>Selecciona un empleado</option>
                <option v-for="empleado in empleados_data" :value="empleado.id">
                    {{ empleado.nombre }}
                </option>
            </select>-->
            <br>
            <multiselect v-model="newTask.value_empleados" :options="empleados_data" :multiple="true" :close-on-select="false" :clear-on-select="false"
                :preserve-search="true" placeholder="Empleados" label="nombre" track-by="id">
            </multiselect>

            <div v-show="errorMessage">
                <span class="text-xs text-red-500">
                    {{ errorMessage }}
                </span>
            </div>
        </div>
        <div class="p-3 flex justify-between items-end text-sm bg-gray-100">
            <button @click="$emit('task-canceled')" type="reset"
                class="py-1 leading-5 text-gray-600 hover:text-gray-700">
                Cancelar
            </button>
            <button type="submit" class="px-3 py-1 leading-5 text-white bg-blue-700 hover:bg-blue-800 rounded">
                Agregar
            </button>
        </div>
    </form>
</template>

<script>
export default {
    components: {
        Multiselect: window.VueMultiselect.default
    },
    props: {
        statusId: Number
    },
    data() {
        return {
            newTask: {
                title: "",
                description: "",
                status_id: null,
                user_id: null,
                value_empleados: []
            },
            errorMessage: "",
            empleados_data: [],
        };
    },
    mounted() {
        this.newTask.status_id = this.statusId;
        this.get_empleados();
        this.my_data();
    },
    methods: {
        handleAddNewTask() {
            // Basic validation so we don't send an empty task to the server
            if (!this.newTask.title) {
                this.errorMessage = "El campo del título es obligatorio";
                return;
            }

            if (this.newTask.value_empleados.length == 0){
                this.errorMessage = "Debes seleccionar al menos un empleado";
                return;
            }

            // Send new task to server
            axios
                .post("/tasks", this.newTask)
                .then(res => {
                    // Tell the parent component we've added a new task and include it
                    this.$emit("task-added", res.data);
                })
                .catch(err => {
                    // Handle the error returned from our request
                    this.handleErrors(err);
                });
        },
        handleErrors(err) {
            if (err.response && err.response.status === 422) {
                // We have a validation error
                const errorBag = err.response.data.errors;
                if (errorBag.title) {
                    this.errorMessage = errorBag.title[0];
                } else if (errorBag.description) {
                    this.errorMessage = errorBag.description[0];
                } else {
                    this.errorMessage = err.response.message;
                }
            } else {
                // We have bigger problems
                console.log(err.response);
            }
        },
        get_empleados() {
            axios.get("/empleados_actives").then(response => {
                this.empleados_data = response.data.data;
            });
        },
        my_data() {
            let user = JSON.parse(localStorage.getItem("user"));
            this.newTask.user_id = user.id;
        }
    }
};
</script>