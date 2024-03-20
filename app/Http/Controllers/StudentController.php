<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));

        //alternativas a compact
        //return view('students.index')->with('students', $students);
        //return view('students.index', ['students' => $students]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'age' => 'required|integer|min:1',
        ]);

         // Crear un nuevo estudiante usando el método `create` del modelo
        Student::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('students.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'age' => 'required|integer|min:1',
        ]);

        // Buscar el estudiante por su ID
        $student = Student::findOrFail($id);

        // Actualizar los datos del estudiante
        $student->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('students.index');
    }

    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()->route('students.index');
    }
}
