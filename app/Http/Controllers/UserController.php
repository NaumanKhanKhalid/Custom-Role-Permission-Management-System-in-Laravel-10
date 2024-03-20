<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserBasicInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $roles = Role::all();
        $query = User::whereNot('id', Auth::user()->id)->with('role', 'basic_info');

        // Filtering based on role
        if ($request->has('role') && $request->role !== null) {
            $query->where('role_id', $request->role);
        }

        // Filtering based on status
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Include trashed users
        if ($request->has('trashed') && $request->trashed == true) {
            $query->onlyTrashed();
        }


        $users = $query->get();
        $totalUsersCount = User::count();
        $activeUsersCount = User::where('status', 'Active')->count();
        $inactiveUsersCount = User::where('status', 'Inactive')->count();
        $trashedUsersCount = User::onlyTrashed()->count();
        return view('modules.users.index', compact('roles', 'users', 'totalUsersCount', 'activeUsersCount', 'inactiveUsersCount', 'trashedUsersCount'));
    }

    public function create()
    {
    }

    public function store(UserRequest $request)
    {

        try {
            // Start a database transaction
            DB::beginTransaction();

            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile_pictures'), $imageName);
                $profilePicturePath = 'profile_pictures/' . $imageName;
            }

            // Create the user
            $user = User::create([
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'role_id' => $request['role_id'],
                'status' => $request['status'],
            ]);

            // Create the user Basic Information
            $userbasicInformation = UserBasicInformation::create([
                'user_id' => $user->id,
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'dob' => $request['dob'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'profile_picture' => $profilePicturePath,
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('user.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            Log::error('User Created' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create user. Please try again.' . $e);
        }
    }

    public function show(User $user)
    {

        $user->load('basic_info');
        return view('modules.users.view', compact('user'));
    }

    
    public function edit(User $user)
    {
        $user->load('basic_info');
        return view('modules.users.edit', compact('user'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            // Prepare user data for update
            $userData = [
                'email' => $request->input('email'),
                'status' => $request->input('status'),
            ];

            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->input('password'));
            }

            // Update user data
            $user->update($userData);

            // Prepare basic information data for update
            $basicInfoData = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'dob' => Carbon::parse($request->input('dob'))->format('Y-m-d'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ];

            // Update profile picture if provided
            if ($request->hasFile('profile_picture')) {
                $userImage = $user->basic_info->profile_picture;
                if ($userImage) {
                    $imagePath = public_path($userImage);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $image = $request->file('profile_picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile_pictures'), $imageName);
                $profilePicturePath = 'profile_pictures/' . $imageName;
                $basicInfoData['profile_picture'] = $profilePicturePath;
            }

            // Update user's basic information
            $userBasicInfo = UserBasicInformation::where('user_id', $user->id)->first();
            $userBasicInfo->update($basicInfoData);

            // Commit the transaction
            DB::commit();

            return redirect()->route('user.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollback();
            Log::error('User Update Error: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Failed to update user. Please try again.');
        }
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return back()->with('success', 'User has been deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to delete user. Please try again.');
        }
    }

    public function updateStatus(Request $request, User $user)
    {

        try {
            $status = $request->input('status');
            $user->update(['status' => $status]);
            return back()->with('success', 'User status updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update user status. Please try again.');
        }
    }

    public function userPermanentDelete($id)
    {

        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user.index')->with('success', 'User permanently deleted.');
    }
    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('success', 'User restored successfully.');
    }
}
