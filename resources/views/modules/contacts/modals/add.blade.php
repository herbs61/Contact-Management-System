<div id="addcontactModal" class="fixed inset-0 hidden z-50 bg-opacity-50 flex justify-center items-center">

    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-semibold mb-4">Add Contact</h2>
        <form id="addContactForm">
            @csrf
            <div class="mb-4">
                <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="fname" id="fname" required class="mt-1 block w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" name="mname" id="mname" class="mt-1 block w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="lname" id="lname" required class="mt-1 block w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" required class="mt-1 block w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" required class="mt-1 block w-full px-3 py-2 border rounded">
            </div>
            
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addcontactModal')" class="text-gray-500 mr-4">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>
    </div>
</div>

