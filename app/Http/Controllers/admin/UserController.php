<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Enums\RolesType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countOwner = $this->getTotalOwner();
        $countUser = $this->getTotalUser();
        $users = User::where('role', '!=', RolesType::ADMIN)->get();
        confirmDelete('Delete data user', 'Are you sure you want to delete this user data?');

        return view('GO.ADMIN.user.index', compact('users', 'countOwner', 'countUser'));
    }

    public function getTotalOwner()
    {
        $countOwner = DB::select('SELECT countOwner() AS total')[0]->total;
        return $countOwner;
    }

    public function getTotalUser()
    {
        $countUser = DB::select('SELECT countUser() AS total')[0]->total;
        return $countUser;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('GO.ADMIN.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:dns|unique:users,email',
            'password' => ['required', 'string', Password::min(8)->numbers()],
            'role' => [Rule::enum(RolesType::class), 'required']
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => bcrypt($validate['password']),
                'role' => $validate['role']
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
        return redirect(route('admin.users.index'))->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = RolesType::getValues();

        return view('GO.ADMIN.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email:dns', Rule::unique('users')->ignore($user->id)],
            'phone' => 'max:20',
            'role' => [Rule::enum(RolesType::class), 'required'],
        ]);

        DB::beginTransaction();
        try {
            $user->update($validate);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
        return redirect(route('admin.users.index'))->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'User deletion failed');
        }
        return redirect()->back()->with('success', 'User deleted successfully');
    }

}
