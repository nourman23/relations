<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Authers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\User;

// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Validator;
// use UploadedFile;



class BooksController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => ['index', 'viewBook']]);
    // }
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // protected $fillable = ['book_title', 'book_description', 'book_auther'];

    public function store(Request $request)
    {

        // dd($request->file('book_image'));

        $request->validate(
            [
                'book_title' => 'required',
                'book_description' => 'required',
                'book_auther' => 'required',
                'book_image' => 'required|mimes:png,jpg,jpeg'
            ]
        );

        $image = base64_encode(file_get_contents($request->input('book_image')));

        $Auther_id = self::FindAutherId($request->book_auther);
        //new book information
        $book = Books::create([
            'book_title' => $request->input('book_title'),
            'authers_id' => $Auther_id,
            'book_description' => $request->input('book_description'),
            'book_auther' => $request->input('book_auther'),
            'book_image' =>   $image,
        ]);
        $book->save();
        return redirect('/index');
    }



    public function showAuther(string $name)
    {
        $id = self::FindAutherId($name);
        $Auther = Authers::find($id);

        $books = Books::where('authers_id', $id)->get();

        return view("Auther", ['Auther' => $Auther, 'books' => $books]);
    }

    public function FindAutherId(string $name)
    {
        $AutherId = Authers::select('id')->where('name', 'like', '%' . $name . '%')->get();

        return $AutherId[0]->id;
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
        // $id = self::FindAutherId($findBook->book_auther);
        $Authers = Authers::all();
        // dd(Authers::all());
        return view('update_books', ['request' => $findBook, 'id' => $id, "Authers" => $Authers]);
    }



    public function updateBook(Request $request, $id)
    {
        # code...
        // dd($request->file('book_image'));

        $image = base64_encode(file_get_contents($request->file('book_image')));



        $book = Books::find($id);

        $Auther_id = self::FindAutherId($request->book_auther);

        $book->book_title = $request->book_title;
        $book->book_description = $request->book_description;
        $book->book_auther = $request->book_auther;
        $book->authers_id = $Auther_id;
        $book->book_image = $image;
        $book->save();
        // return redirect('/index');
        return redirect('/index')->with(["books", $book]);
    }

    public function findBook(Request $request)
    {
        $book = Books::where('book_title', 'like', '%' . $request->search . '%')->get();

        // dd($book);
        return view('index', ['books' => $book, "from" => "search"]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Books::find($id)->delete();

        return back();
    }



    // the extra mehods

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



    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $validateData = $request->only('email', 'password');


        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($validateData, $remember_me)) {
            return redirect()->intended('/index');
        }
        return redirect('login')->with('failed', 'login details are not valid');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }


    //autherization :

    // public function customLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);


    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials) && GATE::allows('admin')) {
    //         return redirect()->intended('dashboard')
    //             ->withSuccess('Signed in');
    //     } else if (Auth::attempt($credentials) && GATE::denies('admin')) {
    //         return redirect()->intended('user')
    //             ->withSuccess('Signed in');
    //     }

    //     return redirect("login")->withSuccess('Login details are not valid');
    // }


    public function registration()
    {

        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("index")->withSuccess('have signed-in');
    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    // public function dashboard()
    // {
    //     if (Auth::check()) {
    //         return view('auth.dashboard');
    //     }

    //     return redirect("login")->withSuccess('are not allowed to access');
    // }


    // public function signOut()
    // {
    //     Session::flush();
    //     Auth::logout();

    //     return Redirect('login');
    // }

    // public function login()
    // {
    //     return view('auth.login');
    // }
}