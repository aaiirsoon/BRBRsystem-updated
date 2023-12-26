<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BorrowHistory;
use Yajra\DataTables\Facades\DataTables;

class BorrowReturnController extends Controller
{
    
    public function index(Request $request)
    {
   
        // $books = Book::latest()->get();
        
        // if ($request->ajax()) {
        //     $data = Book::latest()->get();
        //     return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
   
        //                    $btn = '<button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook" >Edit</button>';
   
        //                    $btn = $btn.' <button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</button>';


                           
    
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        // return view('borrowreturn',compact('books'));

        $borrowHistory = BorrowHistory::latest()->get();
        
        if ($request->ajax()) {
            $data = BorrowHistory::latest()->get();
            return DataTables::of($data)
                    ->addColumn('patron_name', function ($borrowHistory) {
                            return $borrowHistory->borrower->name;
                    })
                    ->addColumn('patron_type', function ($borrowHistory) {
                        return $borrowHistory->borrower->type;
                    })
                    ->addColumn('book_title', function ($borrowHistory) {
                        return $borrowHistory->book->title;
                    })
                    ->make(true);
        }
      
        return view('borrowreturn',compact('borrowHistory'));
    }
   
}



    
    


