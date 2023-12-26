<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BorrowController extends Controller
{
    
    public function index(Request $request)
    {
   
        $books = Book::latest()->get();
      
        return view('listbook',compact('books'));
   
    }



    public function show($id)
    {
        $selectedBook = Book::where('id', $id)->first();

        if(request()->ajax()) {
            return response()->json($selectedBook); 
        }
    
        return view('bookdescription',compact('selectedBook'));

        // $selectedBook = Book::where('id', $id)->get();

        // return response('bookdescription',compact('selectedBook'));
    }


    public function borrow($id,$rfid_id)
    {
         //  see  if may available
        $checkIfBookExists = Book::where('id',$id)->where('status','available')->exists();
       

        if($checkIfBookExists){
            // okay pasok, available daw sya

            Book::where('id', $id)
                    ->update(['status' => 'borrowed']); 
                      
            // update status ng book , para magchange name ng button from "Borrow" to "Return"
                $recordBorrow = new BorrowHistory();
                $recordBorrow->borrower_id = $rfid_id; 
                $recordBorrow->book_id = $id; 
                $recordBorrow->borrow_status = 'borrowed'; 
                $recordBorrow->save();

                
                return response()->json(['success' => 'Borrow record created successfully'], 200);

        }else{
            // sorry hindi available
                return response()->json(['success' => 'The book is not existing'], 400);
        }

        


    }

    public function history($book_id){
        $borrowHistory = BorrowHistory::with('borrower')->where('book_id', $book_id);
        return DataTables::of($borrowHistory)
            ->addColumn('patron_name', function ($borrowHistory) {
                return $borrowHistory->borrower->name;
            })
            ->addColumn('patron_type', function ($borrowHistory) {
                return $borrowHistory->borrower->type;
            })
            ->make(true);
    }

}
