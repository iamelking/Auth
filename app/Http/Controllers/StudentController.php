<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:2|max:32',
             'contact' => 'required|numeric|digits_between:6,12',
             'course' => 'required',
        ]);


        if ($request->hasFile('img')) {
            $file = $request->img;
            // $path = public_path()."/photo/";
            // return $path;
            $extension = $file->getClientOriginalExtension();
            $name = (date('Y-m-d').".".time().".".$extension);
            if(Storage::putFileAs('public/photo',$request->file('img'),$name)){

            $student = new Student;
            $student->image = $name;
            $student->name = $request->name;
            $student->contact =$request->contact;
            $student->course = $request->course;
            $student->save();
            }
            
            $message = $request->session()->flash('success','Data Successfully Added! ');
            return redirect()->route('student.index')->with($message);

        }else{

            $img = 'no_avatar.jpg';
            $student = new Student;
            $student->image = $img;
            $student->name = $request->name;
            $student->contact =$request->contact;
            $student->course = $request->course;
            $student->save();

            $message = $request->session()->flash('success','Data Successfully Added! ');
            return redirect()->route('student.index')->with($message);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|min:2|max:32',
             'contact' => 'required|numeric|digits_between:6,12',
             'course' => 'required',
        ]); 

        if ($request->hasFile('img')) {
            $file = $request->img;
            // $path = public_path()."/photo/";
            // return $path;
            $extension = $file->getClientOriginalExtension();
            $name = (date('Y-m-d').".".time().".".$extension);
            if(Storage::putFileAs('public/photo',$request->file('img'),$name)){

            $student = Student::find($id);
            $student->image = $name;
            $student->name = $request->name;
            $student->contact =$request->contact;
            $student->course = $request->course;
            $student->save();
            }

            return redirect()->route('student.index');

        }else{

            
            $student = Student::find($id);
            $student->name = $request->name;
            $student->contact =$request->contact;
            $student->course = $request->course;
            $student->save();

            return redirect()->route('student.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Session()->flash('success','Deleted Successfully!');
        $student = Student::find($id)->delete();

        return back()->with($message);
    }
}
