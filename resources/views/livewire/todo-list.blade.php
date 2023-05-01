<div>

    <div class="todo">
        <header clas="todo-header">
            <h2 class="text-2xl text-center ml-2">{{ Str::ucfirst(Auth::user()->name) }}'s To Do List </h2>
            <!--add items navigation-->
            <div class="task-count mb-4 sm:flex w-full items-center justify-center hidden">
                <div class="tasks text-sm flex items-center mr-4 p-4 bg-white rounded-lg shadow-lg">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>


                    </div>
                    <div>
                        <p class="mb-2 text-center font-medium text-gray-600 dark:text-gray-400">
                            Tasks
                        </p>
                        <p class="text-xl text-center font-semibold text-gray-700 dark:text-gray-200">
                            {{ $tasksTotal }} </p>
                    </div>
                </div>
                <div class="hours flex text-sm items-center mr-4 p-4 bg-white rounded-lg shadow-lg">
                    <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-center font-medium text-gray-600 dark:text-gray-400">
                            Hours
                        </p>
                        <p class="text-xl text-center font-semibold text-gray-700 dark:text-gray-200">
                            {{ $hoursTotal }}
                        </p>
                    </div>
                </div>

            </div>
        </header>
        <x-validation-errors class="mb-4" />
        <div class="todo-form mb-4">
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-2 p-6">
                <div class="lg:col-span-3">
                    <x-label for="task" value="{{ __('I need to...') }}" />
                    <x-input wire:model="task" wire:keydown.enter="addTask" type="text" class="w-full" />
                </div>
                <div class="lg:col-span-2">
                    <x-label for="task" value="{{ __('Hours to complete') }}" />
                    <x-input wire:model="hours" type="text" wire:keydown.enter="addTask" class="w-full" />

                </div>
                <div class="lg:col-span-1">
                    <x-button class="btn bg-indigo-500 mt-6 text-white" wire:click="addTask">Add</x-button>
                </div>
            </div>
        </div>
    </div>
    <div class="todo-list text-sm">
        <ul class="bg-white w-full rounded shadow mb-8">

            @foreach ($tasks as $task)
                <li class="list-group-item">

                    <div class="d-flex justify-content-between align-items-end">
                        @if (isset($editing) && $editing->id == $task->id)
                            <div class="flex flex-wrap justify-around border-b py-4">
                                <div class="">
                                    <x-input class="lg:w-80" wire:key="editField{{ $task }}" type="text"
                                        wire:keydown.enter="updateTask" wire:model="editing.task" />
                                </div>
                                <div class="">
                                    <x-input class="lg:w-24" wire:key="editField{{ $hours }}" type="text"
                                        wire:keydown.enter="updateTask" wire:model="editing.hours" />
                                </div>

                                <div class="flex mt-4 lg:mt-0 flex-wrap justify-between">
                                    <button class="text-green-600  mr-8" wire:click="updateTask()"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>Update
                                    </button>
                                    <button class="text-red-600" wire:click="cancelEdit()"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>Cancel
                                    </button>

                                </div>
                            </div>
                        @else
                            <div class="flex justify-around border-b py-4">
                                <div class="w-1/12 text-center">
                                    <input type="checkbox"
                                        class="{{ isset($task->completed_at) ? 'bg-green-500' : '' }}"
                                        {{ isset($task->completed_at) ? 'checked' : '' }} value="1"
                                        wire:click="markCompleted({{ $task->id }})" />
                                </div>
                                <div class="w-6/12 flex">
                                    <p class="{{ isset($task->completed_at) ? 'line-through' : '' }}">
                                        {{ $task->task }} </p>
                                </div>
                                <div class="3/12 flex">
                                    <p class="{{ isset($task->completed_at) ? 'line-through' : '' }}">
                                        {{ $task->hours }}</p>
                                </div>
                                <div class="w-2/12">
                                    <button class="text-green-500"
                                        wire:click="selectTaskForEdit({{ $task->id }})"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button class="text-red-600 ml-4"
                                        wire:click="deleteTask({{ $task->id }})"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>


    </div>

</div>
