<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        abort_unless(
            auth()->user()->role === 'admin',
            403,
            'Admin access required.'
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return UserResource::collection($users)->additional([
            'msg'    => 'Users retrieved successfully.',
            'status' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:admin,manager,user'],
            'status'   => ['required', 'in:active,inactive,suspended'],
        ]);
        $user = User::create($validated);
        return (new UserResource($user))
            ->additional([
                'msg'    => 'User created successfully.',
                'status' => true,
            ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return (new UserResource($user))->additional([
            'msg'    => 'User retrieved successfully.',
            'status' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user      = User::findOrFail($id);
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role'     => ['required', 'in:admin,manager,user'],
            'status'   => ['required', 'in:active,inactive,suspended'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        if (empty($validated['password'])) {
            unset($validated['password']);
        }
        $user->update($validated);
        return (new UserResource($user))->additional([
            'msg'    => 'User updated successfully.',
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return response()->json([
                'msg'    => 'You cannot delete your own account.',
                'status' => false,
            ], 422);
        }
        if ($user->ownedProjects()->exists()) {
            return response()->json([
                'msg'    => 'This user cannot be deleted because they own projects.',
                'status' => false,
            ], 422);
        }
        $user->delete();
        return response()->json([
            'msg'    => 'User deleted successfully.',
            'status' => true,
        ]);
    }
}
