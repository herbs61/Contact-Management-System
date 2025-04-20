<div id="editContactModal" class="hidden fixed inset-0   bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h3 class="text-xl font-bold mb-4">Edit Zone</h3>
        <form id="editContactForm">
            <input type="hidden" id="editId">
            <div class="mb-4">
                <label for="editFname" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="fname" id="editFname" class="w-full p-2 border rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="editMname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" name="mname" id="editMname" class="w-full p-2 border rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="editLname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="lname" id="editLname" class="w-full p-2 border rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="editPhone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="editPhone" class="w-full p-2 border rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="editEmail" class="w-full p-2 border rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="editAddress" class="block text-sm font-medium text-gray-700">address</label>
                <input type="text" name="address" id="editAddress" class="w-full p-2 border rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>


            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                <button type="button" onclick="closeModal('editContactModal')" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 hover:bg-gray-600">Cancel</button>
            </div>
        </form>
    </div>
</div>