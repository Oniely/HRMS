<div id="admin_modal_container" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1000] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-white bg-opacity-40 shadow-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div id="admin_modal" class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create New Admin Account
                </h3>
                <button id="close_btn" class="close_btn hover:bg-neutral-200 rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#999" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form action="/HRMS/admin/functions/admin/create_admin_account.php" method="POST" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-2">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="This will be used for login" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Your password here" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                        <input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Thomas" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                        <input type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Verstappen" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="contact" class="block mb-2 text-sm font-medium text-gray-900">Contact</label>
                        <input type="tel" name="contact" id="contact" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="+63" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                        <input type="text" name="position" id="position" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Head Administrator" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="privilage" class="block mb-2 text-sm font-medium text-gray-900">Admin Privilage</label>
                        <select id="privilage" name="privilage" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2">
                            <option value="" selected disabled hidden>Select your option</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <button id="createAccount" name="createAccount" type="submit" class="text-white inline-flex items-center bg-[#4763ca] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center col-span-2 sm:w-fit w-full justify-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add new admin account
                </button>
            </form>
        </div>
    </div>
</div>