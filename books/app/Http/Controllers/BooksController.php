<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\UploadedFile;
// use UploadedFile;



class BooksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = Books::all();

        return view('index', ['books' => $books, 'from' => 'index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // protected $fillable = ['book_title', 'book_description', 'book_auther'];

    public function store(Request $request)
    {

        $request->validate(
            [
                'book_title' => 'required',
                'book_description' => 'required',
                'book_auther' => 'required',
                'book_image' => 'required|mimes:png,jpg,jpeg'
            ]
        );

        // $newImageName = time() . '-' . $request->book_title . '.' . $request->book_image->extension();

        // //store the image :

        // $request->book_image->move(public_path('images'), $newImageName);

        $image = base64_encode(file_get_contents($request->file('book_image')));


        //new book information
        $book = Books::create([
            'book_title' => $request->input('book_title'),
            'book_description' => $request->input('book_description'),
            'book_auther' => $request->input('book_auther'),
            'book_image' =>   $image,
        ]);
        // $book = new Books();

        // $book->book_title = $request->book_title;
        // $book->book_description = $request->book_description;
        // $book->book_auther = $request->book_auther;
        // $book->book_image = $newImageName;


        $book->save();
        return redirect('/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $findBook = Books::find($id);
        // dd($findBook);
        return view('update_books', ['request' => $findBook, 'id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $book = Books::find($id);
        // $book->delete();
        // return redirect('/index');

        Books::find($id)->delete();

        return back();
    }

    public function updateBook(Request $request, $id)
    {
        # code...

        $image = base64_encode(file_get_contents($request->file('book_image')));

        $book = Books::find($id);
        $book->book_title = $request->book_title;
        $book->book_description = $request->book_description;
        $book->book_auther = $request->book_auther;
        $book->book_image = $image;
        $book->save();
        return redirect('/index', ["books", $book]);
    }

    public function findBook(Request $request)
    {
        $book = Books::where('book_title', 'like', '%' . $request->search . '%')->get();

        // dd($book);
        return view('index', ['books' => $book, "from" => "search"]);
    }

    public function Trash()
    {
        $books = Books::onlyTrashed()->get();

        // echo "welcome";
        return view('Trash', ['books' => $books]);
    }

    public function restore($id)
    {
        Books::withTrashed()->where('id', $id)->restore();
        return redirect('/index');
    }
    public function sortUp()
    {
        $sortData = Books::orderBy('updated_at', 'desc')->get();
        return view('index', ['books' => $sortData, "from" => "sortUp"]);
    }
    public function sortDown()
    {
        $sortData = Books::orderBy('updated_at', 'Asc')->get();
        return view('index', ['books' => $sortData, "from" => "sortDown"]);
    }
}