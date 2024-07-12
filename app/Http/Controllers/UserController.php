<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // fitur pagination
        $max_view = 8;

        // fitur pencarian
        if (request('search')) {
            $users = User::where('name', 'like', '%' . request('search') . '%')->paginate($max_view)->withQueryString();
        } else {
            $users = User::orderBy('name')->paginate($max_view);
        }

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|min:3|max:50',
                'password' => 'required|min:3|max:20',
                'email' => 'required|min:3|max:50',

            ],
            [
                'name.required' => 'name user Wajib Diisi',
                'name.min' => 'name user Minimal 3 Karakter',
                'name.max' => 'name user Maximal 50 Karakter',
            ],
            [
                'password.required' => 'password  Wajib Diisi',
                'password.min' => 'password  Minimal 3 Karakter',
                'password.max' => 'password  Maximal 20 Karakter',
            ]
        );

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->newPassword)
        ];

        User::create($data);
        return redirect()->route('user.create')->with('success', 'berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('dashboard.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:50',
                'password' => 'required|min:3|max:20',
                'email' => 'required|min:3|max:50',

            ],
            [
                'name.required' => 'name user Wajib Diisi',
                'name.min' => 'name user Minimal 3 Karakter',
                'name.max' => 'name user Maximal 50 Karakter',
            ],
            [
                'password.required' => 'password  Wajib Diisi',
                'password.min' => 'password  Minimal 3 Karakter',
                'password.max' => 'password  Maximal 20 Karakter',
            ]
        );

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ];


        $users = User::findOrFail($id);
        $users->update($data);

        return redirect()->route('user.edit', $users->id)->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('/dashboard/users')->with('success', 'Berhasil menghapus data!');
    }

    public function assignRole()
    {
        $user = User::find(1); // Mengambil user dengan ID 1
        $role = Role::findByName('admin'); // Mengambil role 'admin'

        $user->assignRole($role);

        return "Role 'admin' telah ditugaskan ke user";
    }
}
