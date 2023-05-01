<div>
    <div>
        <div class="todo">
            <header clas="todo-header">
                <h2 class="text-2xl text-center ml-2">To Do List </h2>
            </header>
            <x-validation-errors class="mb-4" />
            <div class="todo-form mb-4">
                <div class="grid grid-cols-6 gap-2 p-6">
                    <div class="col-span-3">
                        <x-label for="task" value="{{ __('I need to...') }}" />
                        <x-input wire:model="task" wire:keydown.enter="addTask" type="text" class="w-full" />
                    </div>
                    <div class="col-span-2">
                        <x-label for="task" value="{{ __('Hours to complete') }}" />
                        <x-input wire:model="hours" type="text" wire:keydown.enter="addTask" class="w-full" />

                    </div>
                    <div class="col-span-1">
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
                                <div class="flex justify-around border-b py-4">
                                    <div class="">
                                        <x-input class="w-80" wire:key="editField{{ $task }}" type="text"
                                            wire:keydown.enter="updateTask" wire:model="editing.task" />
                                    </div>
                                    <div class="">
                                        <x-input class="w-24" wire:key="editField{{ $hours }}" type="text"
                                            wire:keydown.enter="updateTask" wire:model="editing.hours" />
                                    </div>

                                    <div class="flex justify-between">
                                        <button class="text-green-600 mr-8" wire:click="updateTask()"><svg
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
