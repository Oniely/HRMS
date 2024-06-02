<div id="edit_department_modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1000] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-white bg-opacity-40 shadow-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Account Department Sector
                </h3>
                <button id="close_btn" class="close_btn hover:bg-neutral-200 rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#999" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" class="p-4 md:p-5" id="editAccountForm">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="dept_username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="dept_username" id="dept_username" placeholder="Your new username" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2">
                    </div>
                    <div class="col-span-2">
                        <label for="dept_password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="dept_password" id="dept_password" placeholder="Your new password" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2">
                    </div>
                </div>
                <button id="editAccountBtnDept" name="editAccountBtnDept" type="submit" class="text-white inline-flex items-center bg-[#4763ca] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4 col-span-2 sm:w-fit w-full justify-center">
                    Update Account
                </button>
            </form>
        </div>
    </div>
</div>