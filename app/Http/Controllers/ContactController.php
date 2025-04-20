<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $user = User::all();
        $contacts = Contact::where('deleted', 0)
            ->paginate(15);

        return view('modules.contacts.index', compact('contacts', 'user'));
    }


    // Search for group by code or name
    public function search(Request $request)
    {
        $query = $request->input('query'); // Ensure this matches the input name in the form.
       
        $contacts = Contact::where('deleted', 0)
        ->where(function ($search) use ($query) {
            $search->where('fname', 'LIKE', "%{$query}%")
                ->orWhere('mname', 'LIKE', "%{$query}%")
                ->orWhere('lname', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$query}%")
                ->orWhere('id', 'LIKE', "%{$query}%")
                ->orWhere('address', 'LIKE', "%{$query}%");
        })
        ->paginate(15)
        ->appends(['query' => $query]);
    return view('modules.contacts.index', compact('contacts'));
}

    public function store(ContactRequest $request)
    {

        // Get the authenticated user's ID
        $user_id = auth()->id();

        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id; // Add user_id to the validated data


        $contacts = Contact::create($validatedData);

        // Check if zone exists
        if (!$contacts) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found'
            ], 404);
        }

        // Return the zone data in JSON format
        return response()->json([
            'success' => true,
            'contacts' => $contacts
        ]);
    }

    public function edit($id)
    {
        $contact = Contact::where('id', $id)->first();

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found'
            ], 404);
        }

        return response()->json([
            'success'   => true,
            'contact' => $contact
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
        ]);

        $contact = Contact::where('id',$id)->first();
        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }
    
        // Update the contact attributes
        $contact->update([
            'fname' => $validatedData['fname'],
            'mname' => $validatedData['mname'],
            'lname' => $validatedData['lname'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'modifyuser' => $validatedData['email'],
        ]);
    
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully!',
            'contact' => $contact,
        ]);
    
    
    }


    public function softDelete(Request $request, $id)
{
    // Find the contact by transid
    $contact = Contact::where('id', $id)->first();

    if ($contact) {
        // Mark the contact as deleted (set deleted column to 1)
        $contact->update([
            'deleted' => 1,
           'modifyuser' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact successfully deleted.',
            'contact' => $contact,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Contact not found.',
    ], 404);
    }
}
