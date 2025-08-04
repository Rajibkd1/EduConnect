<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\User;

class SearchTutorController extends Controller
{
    public function index(Request $request)
    {
        // Get all subjects for the filter dropdown
        $subjects = Subject::all();
        
        // Start with all tutors query
        $tutorsQuery = Tutor::with(['user', 'subjects'])
            ->whereHas('user', function($query) {
                $query->where('user_type', 'tutor');
            });

        // Apply subject filter if provided
        if ($request->filled('subject')) {
            $tutorsQuery->whereHas('subjects', function($query) use ($request) {
                $query->where('subjects.id', $request->subject);
            });
        }

        // Apply search by name if provided
        if ($request->filled('search')) {
            $tutorsQuery->whereHas('user', function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Apply university filter if provided
        if ($request->filled('university')) {
            $tutorsQuery->where('university_name', 'like', '%' . $request->university . '%');
        }

        // Apply department filter if provided
        if ($request->filled('department')) {
            $tutorsQuery->where('department', 'like', '%' . $request->department . '%');
        }

        // Apply rating filter if provided
        if ($request->filled('min_rating')) {
            $tutorsQuery->where('rating', '>=', $request->min_rating);
        }

        // Get the filtered tutors
        $tutors = $tutorsQuery->paginate(12);

        return view('search-tutor', compact('tutors', 'subjects'));
    }

    public function show($id)
    {
        $tutor = Tutor::with(['user', 'subjects'])->findOrFail($id);
        
        return view('tutor-profile', compact('tutor'));
    }
}
