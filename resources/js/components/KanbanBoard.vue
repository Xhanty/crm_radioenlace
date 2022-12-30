<template>
    <div class="relative p-2 flex overflow-x-auto h-full justify-center">
        <!-- Columns (Statuses) -->
        <div v-for="status in statuses" :key="status.slug" class="mr-6 w-4/5 max-w-xs flex-shrink-0">
            <div class="rounded-md shadow-md overflow-hidden">
                <div class="p-3 flex justify-between items-baseline bg-gray-700">
                    <h4 class="font-medium" :class="status.color">
                        {{ status.title }}
                    </h4>
                    <button @click="openAddTaskForm(status.id)" class="py-1 px-2 text-sm text-white hover:no-underline">
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
                            <div v-for="task in status.tasks" :id="task.id" :key="task.id" @click="expandDetails(task)"
                                class="mb-3 p-4 flex flex-col bg-white rounded-md shadow transform hover:shadow-md"
                                style="cursor: grab;">
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
                                        :src="'/images/empleados/' + task.user.avatar" alt="">
                                </div>
                            </div>
                            <!-- ./Tasks -->
                        </transition-group>
                    </draggable>
                    <!-- No Tasks -->
                    <div v-show="!status.tasks.length && newTaskForStatus !== status.id"
                        class="flex-1 p-4 flex flex-col items-center justify-center">
                        <span class="text-gray-600">Aún no hay asignaciones</span>
                        <button class="mt-1 text-sm text-blue-700 hover:no-underline"
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
                            <div class="w-5/6 overflow-auto h-128 px-1.5">
                                <div>
                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asignación</label>
                                    <input type="text" :disabled="disabledCreador" v-model="taskSelected.title"
                                        class="block p-2.5 rounded border border-gray-300 w-full text-md font-normal text-gray-900 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <br>
                                <div class="">
                                    <form>
                                        <input type="file" ref="filegeneral" class="hidden" @change="uploadFiles"
                                            multiple />
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                                        <div
                                            class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                                <textarea id="comment" rows="4" :disabled="disabledCreador"
                                                    v-model="taskSelected.description"
                                                    class="resize-none w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                                    placeholder="Ingrese la descripción aquí">{{ taskSelected.description }}</textarea>
                                            </div>
                                            <div v-show="permisoCreador"
                                                class="flex items-center justify-end px-3 py-2 border-t dark:border-gray-600">
                                                <div class="flex pl-0 space-x-1 sm:pl-2">
                                                    <button type="button" @click="$refs.filegeneral.click()"
                                                        class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                    <button type="button" @click="changeTask"
                                                        class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                        <svg aria-hidden="true" class="w-6 h-6 rotate-90"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="">
                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Archivos
                                        Adjuntos</label>

                                    <div class="grid gap-4 grid-cols-4">
                                        <div v-for="file in anexosTask" :key="file.id"
                                            class="w-48 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                            <div class="flex justify-end px-4" v-show="permisoCreador">
                                                <button @click="deleteFile(file)"
                                                    class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"
                                                    type="button">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M3 5a1 1 0 011-1h12a1 1 0 011 1v1H3V5zm12 2v9a2 2 0 01-2 2H7a2 2 0 01-2-2V7h10zm-5 2a1 1 0 00-1 1v4a1 1 0 002 0V9a1 1 0 00-1-1zm4 0a1 1 0 00-1 1v4a1 1 0 002 0V9a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div @click="openFile(file)"
                                                class="flex flex-col items-center pb-2 py-1 cursor-pointer">
                                                <img class="w-20 h-20" src="/assets/img/icon-file.png"
                                                    :alt="file.name_file" />
                                                <p
                                                    class="mb-1 text-sm font-medium text-gray-600 dark:text-white text-center px-1.5">
                                                    {{ file.name_file }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div>
                                    <form>
                                        <div
                                            class="w-full p-4 bg-white border rounded-lg shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700">
                                            <div class="flex items-center justify-between mb-4">
                                                <h5
                                                    class="text-md font-bold leading-none text-gray-900 dark:text-white">
                                                    Observaciones</h5>
                                            </div>
                                            <div class="flow-root">
                                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                                    <li class="py-2 sm:py-2" v-for="avance of avancesTask"
                                                        :key="avance.id">
                                                        <div class="flex items-center space-x-4">
                                                            <div class="flex-shrink-0">
                                                                <img class="w-8 h-8 rounded-full"
                                                                    :title="avance.empleado"
                                                                    :src="'/images/empleados/' + avance.avatar"
                                                                    alt="Neil image">
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p
                                                                    class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                    {{ avance.empleado }}
                                                                </p>
                                                                <p
                                                                    class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                    {{ avance.avance }}
                                                                </p>
                                                                <p
                                                                    class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                                                    {{ avance.fecha }}
                                                                </p>
                                                            </div>
                                                            <div
                                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                                <button @click="deleteAvance(avance)" title="Eliminar"
                                                                    class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"
                                                                    type="button">
                                                                    <svg class="w-5 h-5" fill="currentColor"
                                                                        viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M3 5a1 1 0 011-1h12a1 1 0 011 1v1H3V5zm12 2v9a2 2 0 01-2 2H7a2 2 0 01-2-2V7h10zm-5 2a1 1 0 00-1 1v4a1 1 0 002 0V9a1 1 0 00-1-1zm4 0a1 1 0 00-1 1v4a1 1 0 002 0V9a1 1 0 00-1-1z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <br>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Actividad</label>
                                        <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700"
                                            v-show="permisoActividad">
                                            <img class="w-10 h-10 rounded-full object-cover"
                                                :src="'/images/empleados/' + userCreator.avatar" alt="avatar">
                                            <div class="flex items-center w-full">
                                                <textarea rows="1" v-model="actividad"
                                                    class="resize-none block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Ingrese su observación aquí"></textarea>
                                                <button type="button"
                                                    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" @click="addActividad"
                                                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-6 h-6 rotate-90"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="py-6 pl-6 w-2/6 pr-0">
                                <h3
                                    class="text-md py-4 px-6 font-medium border-2 rounded border-gray-200 text-gray-700 dark:text-white">
                                    Detalles</h3>
                                <form class="space-y-6 py-6 px-4 rounded border-gray-200 border-2 border-t-0"
                                    action="#">
                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Responsable</p>
                                        </div>
                                        <div class="w-4/6">
                                            <select id="countries" v-model="taskSelected.user_id"
                                                :disabled="disabledCreador" @change="changeTask"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" disabled>Selecciona un empleado</option>
                                                <option v-for="empleado in empleados_data" :value="empleado.id">
                                                    {{ empleado.nombre }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Fecha Inicio</p>
                                        </div>
                                        <div class="w-4/6">
                                            <input type="date" v-model="taskSelected.init_date"
                                                :disabled="disabledCreador" @change="changeTask"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                        </div>
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Fecha Fin</p>
                                        </div>
                                        <div class="w-4/6">
                                            <input type="date" v-model="taskSelected.end_date"
                                                :disabled="disabledCreador" @change="changeTask"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                        </div>
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="justify-center self-center">
                                            <p href="#" class="text-sm text-black-800">Informador</p>
                                        </div>
                                        <div class="w-4/6">
                                            <select id="countries" v-model="taskSelected.created_by" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" disabled>Selecciona un empleado</option>
                                                <option v-for="empleado in empleados_data" :value="empleado.id">
                                                    {{ empleado.nombre }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex justify-center" v-show="permisoCreador">
                                        <div class="justify-center self-center">
                                            <a href="#" data-modal-toggle="popup-modal"
                                                class="text-sm text-red-600">Eliminar Asignación</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="popup-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Desea eliminar la
                            asignación?</h3>
                        <button data-modal-toggle="popup-modal" type="button" @click="deleteTask"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Sí, Eliminar
                        </button>
                        <button data-modal-toggle="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            Cancelar</button>
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
            userSelected: [],
            userCreator: [],
            modal: null,
            empleados_data: [],
            permisoActividad: false,
            permisoCreador: false,
            disabledCreador: true,
            fileGeneral: null,
            anexosTask: [],
            avancesTask: [],
            actividad: "",
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
        this.get_empleados();
        this.my_data();
        this.verifyModal();
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
            this.userSelected = task.user;
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
                    //console.log(this.userCreator);
                    //console.log(this.taskSelected);
                    if (this.userCreator.id == this.taskSelected.created_by) {
                        this.permisoCreador = true;
                        this.permisoActividad = true;
                        this.disabledCreador = false;
                    } else if (this.userCreator.id == this.userSelected.id) {
                        this.permisoActividad = true;
                        this.permisoCreador = false;
                        this.disabledCreador = true;
                    } else {
                        this.permisoActividad = false;
                        this.permisoCreador = false;
                        this.disabledCreador = true;
                    }
                    this.anexosTask = [];
                    this.avancesTask = [];
                    this.actividad = "";
                    this.anexos();
                    this.avances();
                },
                onToggle: () => {
                    //console.log('modal has been toggled');
                }
            };
            this.modal = new Modal(targetEl, options);
            //console.log(task);
            this.modal.show();
        },
        closeDetails() {
            this.modal.hide();
        },
        get_empleados() {
            axios.get("/empleados_actives").then(response => {
                this.empleados_data = response.data.data;
            });
        },
        my_data() {
            let user = JSON.parse(localStorage.getItem("user"));
            this.userCreator = user;
        },
        changeTask() {
            let data = this.taskSelected;
            axios.post("/tasks_edit", data).then(response => {
                this.statuses = response.data;
            });
        },
        deleteTask() {
            let data = this.taskSelected;
            axios.post("/tasks_delete", data).then(response => {
                this.statuses = response.data;
                this.closeDetails();
            });
        },
        anexos() {
            let data = this.taskSelected;
            axios.post("/tasks_anexos", data).then(response => {
                //this.fileGeneral = response.data;
                this.anexosTask = response.data;
                //console.log(response.data);
            });
        },
        deleteFile(file) {
            let data = {
                id: file.id,
                file: file.file,
                task_id: this.taskSelected.id
            };
            axios.post("/task_delete_file", data).then(response => {
                this.anexosTask = response.data;
            });
        },
        openFile(file) {
            window.open("/images/anexos_tasks_projects/" + file.file, '_blank');
        },
        uploadFiles(event) {
            let files = event.target.files;
            let data = new FormData();
            data.append("task_id", this.taskSelected.id);
            for (let i = 0; i < files.length; i++) {
                data.append("file[]", files[i]);
            }
            axios.post("/task_add_file", data).then(response => {
                this.anexosTask = response.data;
            });
        },
        avances() {
            let data = this.taskSelected;
            axios.post("/tasks_avances", data).then(response => {
                this.avancesTask = response.data;
                console.log(response.data);
            });
        },
        addActividad() {
            if (this.actividad.trim().length < 1) {
                alert("Debe ingresar una observación");
                return;
            }

            let data = {
                task_id: this.taskSelected.id,
                actividad: this.actividad
            };

            axios.post("/task_add_avance", data).then(response => {
                this.actividad = "";
                this.avancesTask = response.data;
            });
        },
        deleteAvance(avance) {
            let data = {
                id: avance.id,
                task_id: this.taskSelected.id
            };
            axios.post("/task_delete_avance", data).then(response => {
                this.avancesTask = response.data;
            });
        },
        verifyModal() {
            const valores = window.location.search;
            const urlParams = new URLSearchParams(valores);
            var taskUrl = urlParams.get('task');

            if (taskUrl != null && taskUrl > 0) {
                var taskSelected = [];
                this.statuses.forEach(status => {
                    status.tasks.forEach(task => {
                        if (task.id == taskUrl) {
                            taskSelected = task;
                        }
                    });
                });
                this.expandDetails(taskSelected);
            }
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