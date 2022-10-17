<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<style>

body {

	font-family: "Caveat";
    /* background-color: #2A3166; */
    /* background: #000033
	; */
min-height: 90vh;
  background-image: url("https://www.parentmap.com/sites/default/files/styles/1180x660_scaled_cropped/public/2017-05/books-istock-5-18-17_1.jpg?itok=jc-KwG34");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
h2 {
	font-size: 26px;
    text-align: center;
    color: white;
    margin-bottom: 30px;
}

p {
	margin: 0;
	padding: 0;
    font-size: 20px;
}
.card{
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}
.delUpdBtns{
text-align: center;
display: flex;
justify-content: space-around;
}
.delBtn{
background-color: #fbb0b5;
color: white;
border: none;
}
.updBtn{
  background-color: #7aa39f;
color: white;
}
.AddBookLink{
  margin: 20px auto;
  width: 550px;
  align-content: space-between;
    justify-content: space-around;
    align-items: center;
 
}
.AddBookLinkBtn{
width: 100px;
height: 100px;
box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
display: flex;
align-items: center;
justify-content: center;
border-radius: 50px;
background-color: #fbb0b5;
cursor: pointer;

}
 .AddBookLink a{
  text-decoration: none;
color: white;
}
.AddBookLinkBtn:hover{
  background-color: #a5787b;
}
.card-body .descripSec{
  overflow: auto;
  height: 60px;
}
.card-body p{
  margin: 10px
}
.BookImg{
  height: 250px;
}
.BookImg img{
  height: 100%;
}
.back{
  color: black;
}
.processes a{
  margin: 10px;
  
}
.sortBtn
{
  background-color: #fbb0b5;
  color: white;
}
</style>
</head>
<body>

    <header>
       
      </header>
      
      <div class="AddBookLink d-flex ">
        <div class="searchBooh"> 
          <form action="/findBook" method="POST">
            @csrf
            <div class="mb-3">
              <input name="search" type="text" style="width:300px; margin-left:30px" placeholder="Search for a book" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text"></div>
            </div>
          </form>
        </div>
        <a href="/add"><div class="AddBookLinkBtn">ADD BOOK</div></a>
      </div>
      
      @if ($from == 'search')
<a href="/index" class="back"> Back to index</a>
@endif

<div class=" d-flex flex-wrap m-3 processes">

  <a href="/trash" class="btn btn-danger">Trash
    <lord-icon
        src="https://cdn.lordicon.com/qjwkduhc.json"
        trigger="hover"
        colors="primary:#646e78,secondary:#ffffff,tertiary:#c71f16"
        style="width:30px;height:30px">
    </lord-icon>
    </a>
    <a href="/sortUp"><button  class="btn sortBtn ">sort up</button></a>
     <a href="/sortDown"><button  class="btn sortBtn">sort Down</button></a>

</div>

<div class=" d-flex flex-wrap w-100">


@foreach ($books as $book)

<div id="cardsDiv" class="card m-4" style="width: 16rem;">
<div class="BookImg">   <img src="data:image/jpeg;base64,{{$book['book_image']}}" class="card-img" alt="..." ></div>
    <div class="card-body">
      <h4 class="card-title">{{$book['book_title']}}</h4>
     <p class="card-text">{{$book['book_auther']}}</p>
      <p class="card-text descripSec">{{$book['book_description']}}</p>
      <div class="delUpdBtns">
      {{-- <a href="delete/{{$book['id']}}"  class="btn m-3 delBtn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</a> --}}
      
      <form method="POST" action="{{ route('delete', $book->id) }}">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn m-3 delBtn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
    </form>
      <a href="update/{{$book['id']}}" class="btn m-3 updBtn">Update</a></div>
    </div>
  </div>

  @endforeach
</div>
  <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be found in Trush.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
</html>
