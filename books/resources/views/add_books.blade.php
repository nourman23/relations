<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">
  <style>

body {
  height: 70vh;
  font-size: 20px;
font-family: "Caveat";
background-image: url("https://www.parentmap.com/sites/default/files/styles/1180x660_scaled_cropped/public/2017-05/books-istock-5-18-17_1.jpg?itok=jc-KwG34");
background-size: cover;
background-position: center;
background-repeat: no-repeat;
}
form{
  margin-top:120px; 
}
form .btn{
  background-color:  #fbb0b5;
  color: white;
  width: 100px;
  margin: 10px;
}
.back{
  color: black;
}
  </style>
</head>
<body>
    <div class="container w-25">
    <form action="/req" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Book title</label>
          <input name="book_title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Book Description</label>
          <input name="book_description" type="text" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book author</label>
            <input name="book_auther" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text"></div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book image </label>
            <input name="book_image" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text"></div>
          </div>

        <button type="submit" class="btn ">Add</button>
      </form>

      <a href="/index" class="back"> <= BACK TO THE BOOKS</a>
    </div>
</body>
</html>
