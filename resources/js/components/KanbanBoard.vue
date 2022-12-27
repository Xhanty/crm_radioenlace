<template>
    <div class="relative p-2 flex overflow-x-auto h-full justify-center">
        <!-- Columns (Statuses) -->
        <div v-for="status in statuses" :key="status.slug" class="mr-6 w-4/5 max-w-xs flex-shrink-0">
            <div class="rounded-md shadow-md overflow-hidden">
                <div class="p-3 flex justify-between items-baseline bg-gray-700">
                    <h4 class="font-medium" :class="status.color">
                        {{ status.title }}
                    </h4>
                    <button @click="openAddTaskForm(status.id)"
                        class="py-1 px-2 text-sm text-orange-500 hover:no-underline">
                        Agregar Asignación
                    </button>
                </div>
                <div class="p-2 bg-blue-100">
                    <!-- AddTaskForm -->
                    <AddTaskForm v-if="newTaskForStatus === status.id" :status-id="status.id"
                        v-on:task-added="handleTaskAdded" v-on:task-canceled="closeAddTaskForm" />
                    <!-- ./AddTaskForm -->

                    <!-- Tasks -->
                    <draggable class="flex-1 overflow-hidden" v-model="status.tasks" v-bind="taskDragOptions"
                        @end="handleTaskMoved">
                        <transition-group
                            class="flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto rounded shadow-xs"
                            tag="div">
                            <div v-for="task in status.tasks" :key="task.id" @click="expandDetails(task)"
                                class="mb-3 p-4 flex flex-col bg-white rounded-md shadow transform hover:shadow-md cursor-pointer">
                                <span class="block mb-2 text-lg text-gray-700">
                                    {{ task.title }}
                                </span>
                                <!--<p class="text-gray-700">
                                    {{ task.description }}
                                </p>-->
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-sm text-gray-600">
                                        {{ task.code }}
                                    </span>
                                    <img class="w-8 h-8 rounded-full" :title="task.user.nombre"
                                        :src="'http://127.0.0.1:8000/images/empleados/' + task.user.avatar" alt="">
                                </div>
                            </div>
                            <!-- ./Tasks -->
                        </transition-group>
                    </draggable>
                    <!-- No Tasks -->
                    <div v-show="!status.tasks.length && newTaskForStatus !== status.id"
                        class="flex-1 p-4 flex flex-col items-center justify-center">
                        <span class="text-gray-600">Aún no hay asignaciones</span>
                        <button class="mt-1 text-sm text-orange-600 hover:no-underline"
                            @click="openAddTaskForm(status.id)">
                            Agregar
                        </button>
                    </div>
                    <!-- ./No Tasks -->
                </div>
            </div>
        </div>
        <!-- ./Columns -->

        <!-- Main modal -->
        <div id="taskDetails" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-7xl md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                            {{ taskSelected.code }}
                        </h3>
                        <button type="button" @click="closeDetails"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="flex">
                            <div class="w-4/6">
                                <label for="message"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                                <textarea rows="5"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write your thoughts here...">{{ taskSelected.description }}</textarea>

                            </div>
                            <div class="px-6 py-6 w-2/6">
                                <h3 class="text-md py-4 px-6 font-medium border-2 rounded border-gray-200 text-gray-700 dark:text-white">
                                    Detalles</h3>
                                <form class="space-y-6 py-3 px-6 rounded border-gray-200 border-2 border-t-0" action="#">
                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Responsable</p>
                                        </div>
                                        <div class="w-4/6">
                                            <select id="countries"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected>Choose a country</option>
                                                <option value="US">United States</option>
                                                <option value="CA">Canada</option>
                                                <option value="FR">France</option>
                                                <option value="DE">Germany</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Fecha Inicio</p>
                                        </div>
                                        <div class="w-4/6">
                                            <input type="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                        </div>
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Fecha Fin</p>
                                        </div>
                                        <div class="w-4/6">
                                            <input type="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    
                                        </div>
                                    </div>


                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Informador</p>
                                        </div>
                                        <div class="w-4/6">
                                            <input type="text" :value="taskSelected.code" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import AddTaskForm from "./AddTaskForm";

export default {
    components: { draggable, AddTaskForm },
    props: {
        initialData: Array,
    },
    data() {
        return {
            statuses: [],
            newTaskForStatus: 0,
            taskSelected: [],
            modal: null,
        };
    },
    computed: {
        taskDragOptions() {
            return {
                animation: 200,
                group: "task-list",
                dragClass: "status-drag"
            };
        }
    },
    mounted() {
        // 'clone' the statuses so we don't alter the prop when making changes
        this.statuses = JSON.parse(JSON.stringify(this.initialData));
    },
    methods: {
        openAddTaskForm(statusId) {
            this.newTaskForStatus = statusId;
        },
        closeAddTaskForm() {
            this.newTaskForStatus = 0;
        },
        handleTaskAdded(newTask) {
            // Find the index of the status where we should add the task
            const statusIndex = this.statuses.findIndex(
                status => status.id === newTask.status_id
            );

            // Add newly created task to our column
            this.statuses[statusIndex].tasks.push(newTask);

            // Reset and close the AddTaskForm
            this.closeAddTaskForm();
        },
        handleTaskMoved(evt) {
            axios.put("/tasks/sync", { columns: this.statuses }).catch(err => {
                console.log(err.response);
            });
        },
        expandDetails(task) {
            this.taskSelected = task;
            // set the modal menu element
            const targetEl = document.getElementById('taskDetails');
            // set the modal menu to visible
            // options with default values
            const options = {
                placement: 'top-center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                onHide: () => {
                    //console.log('modal is hidden');
                },
                onShow: () => {
                    //console.log('modal is shown');
                },
                onToggle: () => {
                    //console.log('modal has been toggled');
                }
            };
            this.modal = new Modal(targetEl, options);
            console.log(task);
            this.modal.show();
        },
        closeDetails() {
            this.modal.hide();
        }
    }
};
</script>

<style scoped>
.status-drag {
    transition: transform 0.5s;
    transition-property: all;
}
</style>