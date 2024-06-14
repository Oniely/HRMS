<div id="show_password_modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1000] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-white bg-opacity-40 shadow-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 whitespace-nowrap">
                    Enter Your Password To Proceed
                </h3>
                <button id="close_btn" class="close_btn hover:bg-neutral-200 rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#999" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form id="showPasswordForm" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div id="inputContainer" class="col-span-2 sm:col-span-2">
                        <label for="admin_password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="admin_password" id="admin_password" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Your password here" required="">
                    </div>
                    <div id="passwordContainer" class="hidden col-span-2 space-y-2">
                        <p class="text-sm font-medium">Username: <span id="showed_username">admin</span></p>
                        <p class="text-sm font-medium">Password: <span id="showed_password">admin</span></p>
                        <p class="text-sm text-gray-500 font-light">Closing Automatically in <span id="timer">10</span>s</p>
                    </div>
                </div>
                <button id="showPassword" name="showPassword" type="submit" class="text-white inline-flex items-center bg-[#4763ca] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center col-span-2 sm:w-fit w-full justify-center">
                    Proceed
                </button>
            </form>
        </div>
    </div>
</div>