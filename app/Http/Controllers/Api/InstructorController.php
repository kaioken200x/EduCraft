<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     * This method retrieves a paginated list of instructors
     * with their ID, name, and email.
     * It returns the data in JSON format.
     */
    public function index()
    {
        $instructores = Instructor::select('id', 'name', 'email')
            ->paginate(50);

        return response()->json($instructores);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * This method creates a new instructor with the provided name and email.
     * It returns the created instructor in JSON format.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
        ]);

        $instructor = Instructor::create($validated);
        
        if (!$instructor) {
            return response()->json(['message' => 'Error al crear el instructor.'], 500);
        }

        return response()->json($instructor, 201);
    }
    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * This method retrieves a specific instructor by ID.
     * It returns the instructor's details in JSON format.
     */
    public function show($id)
    {
        $instructor = Instructor::findOrFail($id);

        return response()->json($instructor);
    }
    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * This method updates an existing instructor's details.
     * It returns the updated instructor in JSON format.
     */
    public function update(Request $request, $id)
    {
        $instructor = Instructor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:instructors,email,' . $id,
        ]);

        $instructor->update($validated);

        return response()->json($instructor);
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * This method deletes an instructor by ID.
     * It returns a success message in JSON format.
     */
    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return response()->json(['message' => 'Instructor eliminado.'], 200);
    }
}
