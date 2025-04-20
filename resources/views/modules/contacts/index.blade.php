<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <x-slot name="header">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-200 leading-tight">
                {{ __('Contact') }}
            </h2>
        </x-slot>

        <div class="flex flex-col sm:flex-row justify-between items-center sm:items-start mb-4 gap-2">
            <button onclick="openModal('addcontactModal')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm sm:text-base">
                Add Contact
            </button>
        </div>

        <div class="flex justify-end mb-4">
            <div class="flex items-center border border-blue-300 rounded-full overflow-hidden w-full max-w-xs">
                <form action="{{ route('contacts.search') }}" method="GET" class="flex items-center w-full">
                    <input type="text" name="query" placeholder="Search contacts..."
                        class="flex-1 bg-transparent border-none placeholder-gray-500 text-gray-800 focus:outline-none focus:ring-0 px-4 py-2"
                        value="{{ request()->input('query') }}">
                    <button type="submit" class="text-blue-600 text-xl px-4">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Responsive Table Wrapper -->
        <div class="overflow-x-auto bg-gray-800 rounded shadow-md">
            <table class="min-w-full text-sm">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Phone</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr id="driver-{{ $contact->id }}" class="border-t hover:bg-gray-200">
                        <td class="px-4 py-2">{{ $contact->fname ?? 'N/A' }} {{ $contact->lname ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $contact->email ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $contact->phone ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $contact->address ?? 'N/A' }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <button onclick="openEditModal({{ $contact->id }})"
                                class="text-indigo-600 hover:text-indigo-400 transition-colors">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" onclick="confirmDeletion(this, '{{ $contact->id }}')"
                                class="text-red-600 hover:text-red-400 transition-colors">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    @if ($contacts->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center px-6 py-6 text-gray-200">
                            No contacts found.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $contacts->links('vendor.pagination.simple-tailwind') }}
        </div>

        <!-- Modals -->
        @include('modules.contacts.modals.add')
        @include('modules.contacts.modals.edit')
    </div>

    {{-- Scripts remain unchanged --}}

<script>
     function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }



        
        $(document).ready(function() {
            $('#addContactForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/contacts/create',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem(
                        'authToken'), // Ensure token is stored after loginl
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'), // Include CSRF token header if required

                    },
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                location
                                    .reload(); // Reload the page to show the updated data
                            });
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let key in errors) {
                            errorMessage += errors[key][0] + '\n';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonColor: '#d33',
                        });
                    },
                });
            });
        });


        function openEditModal(id) {
            // Fetch the zone data based on transid
            $.ajax({
                url: `/contacts/${id}/edit`,
                method: 'GET',
                success: function(response) {
                    // Populate the modal fields with the current zone data
                    $('#editId').val(response.contact.id);
                    $('#editFname').val(response.contact.fname);
                    $('#editMname').val(response.contact.mname);
                    $('#editLname').val(response.contact.lname);
                    $('#editPhone').val(response.contact.phone);
                    $('#editEmail').val(response.contact.email);
                    $('#editAddress').val(response.contact.address);
                    

                    document.getElementById('editContactModal').classList.remove('hidden');
                },
                error: function() {
                    alert('Error loading zone data');
                }
            });
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        $('#editContactForm').on('submit', function(e) {
            e.preventDefault();

            const id = $('#editId').val(); // Get the transid from the hidden field
            const fname = $('#editFname').val();
            const mname = $('#editMname').val();
            const lname = $('#editLname').val();
            const phone = $('#editPhone').val();
            const email = $('#editEmail').val();
            const address = $('#editAddress').val();

            $.ajax({
                url: `/contacts/${id}`, // Make sure transid is passed correctly
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    id:id,
                    fname: fname,
                    mname: mname,
                    lname:lname,
                    phone:phone,
                    email:email,
                    address:address,
                   
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                    }).then((result) => {
                        location
                            .reload(); // Reload the page to show the updated data
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for (let key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                    });
                }
            });
        });



        
        function confirmDeletion(button, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/contacts/${id}/delete`,
                        method: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            modifyuser: '{{ Auth::user()->email }}' // Insert authenticated user's email
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message
                                }).then(() => {
                                    location.reload(); // Refresh the page after clicking OK
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong!'
                            });
                        }
                    });
                }
            });
        }




</script>


</x-app-layout>
