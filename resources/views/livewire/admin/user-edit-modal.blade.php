<div>
    <!-- Edit User Modal -->
    <x-ui.modal name="edit-user-modal" :show="$showEditModal" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Edit User') }}
            </h2>

            <form wire:submit.prevent="updateUser">
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <x-ui.input
                            label="Name"
                            type="text"
                            id="name"
                            name="name"
                            wire:model="form.name"
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-ui.input
                            label="Email address"
                            type="email"
                            id="email"
                            name="email"
                            wire:model="form.email"
                        />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-ui.input
                            label="Phone number"
                            type="text"
                            id="phone"
                            name="phone"
                            wire:model="form.phone"
                        />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        type="button"
                        @click="$dispatch('close')"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none dark:bg-blue-700 dark:hover:bg-blue-800"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </x-ui.modal>

    <!-- Delete User Confirmation Modal -->
    <x-ui.modal name="delete-user-modal" :show="$showDeleteModal" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                {{ __('Delete User') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                {{ __('Are you sure you want to delete this user? This action cannot be undone.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <button
                    type="button"
                    @click="$dispatch('close')"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700"
                >
                    Cancel
                </button>
                <button
                    wire:click="deleteUser"
                    class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none dark:bg-red-700 dark:hover:bg-red-800"
                >
                    Delete
                </button>
            </div>
        </div>
    </x-ui.modal>
</div>