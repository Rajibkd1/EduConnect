<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Subject;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        $profile = null;
        $subjects = [];
        $tutorSubjects = [];

        // Get the specific profile based on user type
        if ($user->user_type === 'student') {
            $profile = $user->student;
        } elseif ($user->user_type === 'tutor') {
            $profile = $user->tutor;
            $subjects = Subject::orderBy('name')->get();
            $tutorSubjects = $profile ? $profile->subjects->pluck('id')->toArray() : [];
        } elseif ($user->user_type === 'guardian') {
            $profile = $user->guardian;
        }

        return view('profile', compact('user', 'profile', 'subjects', 'tutorSubjects'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate common fields
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Add user-type specific validation rules
        if ($user->user_type === 'student') {
            $rules = array_merge($rules, [
                'educational_level' => 'nullable|string|max:255',
                'birth_date' => 'nullable|date',
                'current_study_class' => 'nullable|string|max:255',
                'school_college_name' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'phone_number' => 'nullable|string|max:20',
            ]);
        } elseif ($user->user_type === 'tutor') {
            $rules = array_merge($rules, [
                'phone_number' => 'nullable|string|max:20',
                'university_name' => 'nullable|string|max:255',
                'university_id' => 'nullable|string|max:255',
                'department' => 'nullable|string|max:255',
                'semester' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'university_id_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string',
                'qualifications' => 'nullable|string',
                'experience_years' => 'nullable|integer|min:0',
                'subjects' => 'nullable|array',
                'subjects.*' => 'exists:subjects,id',
            ]);
        } elseif ($user->user_type === 'guardian') {
            $rules = array_merge($rules, [
                'child_name' => 'nullable|string|max:255',
                'child_birthdate' => 'nullable|date',
                'current_class' => 'nullable|string|max:255',
                'school_college_name' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'phone_number' => 'nullable|string|max:20',
            ]);
        }

        $validated = $request->validate($rules);

        // Update user basic info
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Handle profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            $profile = $this->getUserProfile($user);
            if ($profile && $profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }

            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Update user-specific profile
        $this->updateUserProfile($user, $validated, $profileImagePath, $request);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    private function getUserProfile($user)
    {
        if ($user->user_type === 'student') {
            return $user->student;
        } elseif ($user->user_type === 'tutor') {
            return $user->tutor;
        } elseif ($user->user_type === 'guardian') {
            return $user->guardian;
        }
        return null;
    }

    private function updateUserProfile($user, $validated, $profileImagePath, $request)
    {
        $profileData = [];

        if ($user->user_type === 'student') {
            $profileData = [
                'educational_level' => $validated['educational_level'] ?? null,
                'birth_date' => $validated['birth_date'] ?? null,
                'current_study_class' => $validated['current_study_class'] ?? null,
                'school_college_name' => $validated['school_college_name'] ?? null,
                'address' => $validated['address'] ?? null,
                'phone_number' => $validated['phone_number'] ?? null,
            ];

            if ($profileImagePath) {
                $profileData['profile_image'] = $profileImagePath;
            }

            $user->student()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );
        } elseif ($user->user_type === 'tutor') {
            $profileData = [
                'name' => $validated['name'],
                'phone_number' => $validated['phone_number'] ?? null,
                'university_name' => $validated['university_name'] ?? null,
                'university_id' => $validated['university_id'] ?? null,
                'department' => $validated['department'] ?? null,
                'semester' => $validated['semester'] ?? null,
                'address' => $validated['address'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'qualifications' => $validated['qualifications'] ?? null,
                'experience_years' => $validated['experience_years'] ?? null,
            ];

            if ($profileImagePath) {
                $profileData['profile_image'] = $profileImagePath;
            }

            // Handle university ID image upload
            if ($request->hasFile('university_id_image')) {
                // Delete old university ID image if exists
                $profile = $user->tutor;
                if ($profile && $profile->university_id_image) {
                    Storage::disk('public')->delete($profile->university_id_image);
                }

                $profileData['university_id_image'] = $request->file('university_id_image')->store('university_ids', 'public');
            }

            $tutor = $user->tutor()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );

            // Update tutor subjects
            if ($request->has('subjects')) {
                $tutor->subjects()->sync($request->subjects);
            } else {
                // If no subjects selected, remove all
                $tutor->subjects()->detach();
            }
        } elseif ($user->user_type === 'guardian') {
            $profileData = [
                'child_name' => $validated['child_name'] ?? null,
                'child_birthdate' => $validated['child_birthdate'] ?? null,
                'current_class' => $validated['current_class'] ?? null,
                'school_college_name' => $validated['school_college_name'] ?? null,
                'address' => $validated['address'] ?? null,
                'phone_number' => $validated['phone_number'] ?? null,
            ];

            if ($profileImagePath) {
                $profileData['profile_image'] = $profileImagePath;
            }

            $user->guardian()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );
        }
    }
}
