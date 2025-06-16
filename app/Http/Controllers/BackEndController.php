<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackEndController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin()
    {
        return view('backEnd.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function teacher()
    {
        return view('backEnd.teacher.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function student()
    {
        return view('backEnd.student.index');
    }

    
}
