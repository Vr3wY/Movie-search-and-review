<!-- PJ2  Vedio search-->
<html>
<head>  <!-- link bootstrap and extenal css to design webpage-->
  <title>HW3</title>
  <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<script>
//function big, small, medium use for changing afornt size
function big(){
  document.getElementById("body").style.fontSize ="x-large";
  for (var i = 0; i < customs.results.length; i++) {
    document.getElementById(i+100).style.fontSize ="large";
      document.getElementById(i+200).style.fontSize ="large";
  }
}
function small(){
    document.getElementById("body").style.fontSize = "x-small";
    for (var i = 0; i < customs.results.length; i++) {
    document.getElementById(i+100).style.fontSize ="xx-small";
      document.getElementById(i+200).style.fontSize ="xx-small";
    }
}
function medium(){
  document.getElementById("body").style.fontSize  = "medium";
  for (var i = 0; i < customs.results.length; i++) {
  document.getElementById(i+100).style.fontSize ="small";
    document.getElementById(i+200).style.fontSize ="small";
  }
}
// function TOP and Down use for moving the webpage to top ar bottom
function TOP() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
function DOWN(){
  document.body.scrollTop = 100000;
  document.documentElement.scrollTop = 10000;
}
</script>

<style>
#body{
  font-size: 100%;
}
h1.head{
  margin: 20px;
  margin-bottom: 30px;
  font-family: Impact, Charcoal, sans-serif;
}
div.card{
  margin-top: 50px;
}
table{
  border-radius: 25px;
  border-width: thick;
  border-color: black;

}
td,tr{
  font-size: 80%;
  padding-left: 15px;
  padding-right: 15px;
  padding-top: 5px;
  padding-bottom: 5px;
}
#big{
  width: 100px;
  position: fixed;
  bottom: 135px;
  left:  30px;
  z-index: 99;
  outline: none;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 15px;
}
#small{
  width: 100px;
  position: fixed;
  bottom: 15px;
  left: 30px;
  z-index: 99;
  outline: none;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 15px;
}
#medium {
  width: 100px;
  position: fixed;
  bottom: 75px;
  left: 30px;
  z-index: 99;
  outline: none;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 15px;
}
#DestinationUP {
  position: fixed;
  bottom: 75px;
  right: 30px;
  z-index: 99;
  outline: none;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 15px;
}
#DestinationDOWN {
  position: fixed;
  bottom: 15px;
  right: 30px;
  z-index: 99;
  outline: none;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 15px;
}
</style>

  <body id="body">
    <form >
      <center>
      <h1 class="head">Video Search </h1>
        <div class ="col-lg-10">
          <div class = "input-group">
            <form >
              <input id="text" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Insert here....    Searching might take a moment">
              <button type="button" class="btn btn-primary" onclick="request()"><b>Submit</b></button>
            </form>
          </div>
          <label>* if comment or OST went wrong please wait and try to click agian</label>
      </div>
    </center>
</form>
<div id="content">  <!-- this container use for display result -->
</div>

<button type="button" class="btn btn-primary" id="DestinationUP" onclick="TOP()"><b>Top</b></button>
<button  type="button" class="btn btn-primary" id="DestinationDOWN" onclick="DOWN()"><b>Bottom</b></button>
<button type="button" class="btn btn-primary" id="small" onclick="small()"><b>Small</b></button>
<button  type="button" class="btn btn-primary" id="medium" onclick="medium()"><b>Medium</b></button>
<button type="button" class="btn btn-primary" id="big" onclick="big()"><b>Big</b></button>


<script>
const TMDbAPI = '????????????????????????????????'
const GVAPI = '???????????????????????????????'
const Poster = '????????????????????????????'
var customs ;
var videos = [];
var S_h =[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
var T_h =[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];

/*
  this function will send a title to The movie database Api then go to search function
*/
function request(){
var contents  = $('#content')
  var q = $('#text').val();
  if(q == ""){
  }else{
      for (var i = 0; i < 20; i++) {
        S_h[i]=1;
        T_h[i]=1;
      }
      contents.html('')
    $.get('https://api.themoviedb.org/3/search/movie',{ //get respond  www. by sending a vedio requirment to get information
      api_key : TMDbAPI,
      query : q,
      page : 1,
      include_adult : "True"
    },search)
  }

}

/*
  This function will send a request to youtube to return video that have a title match to the movie
*/
function search(custom){
  var i=0
  customs = custom
  for ( i = 0; i < customs.results.length; i++) {
      Date = customs.results[i].release_date.split("-");
        $.ajaxSetup({async: false});
   $.get('https://www.googleapis.com/youtube/v3/search',{ //get respond www. by sending a vedio requirment to get information
      part : "snippet",
      key : GVAPI,
      q : customs.results[i].title+" ("+Date[0]+ ") official trailer",
      videoType : 'any',
      type : "video",
      maxResults : 1
    }, video);

    }

    display()
  }
//this function use for add a data to array for using in the futher
 function video(video){
   videos.push(video);
 }

 //this funtion will print and request a comment data from twitter.php

 function tweet(i){
document.getElementById(i+100).innerHTML = "";
if(T_h[i]==1){
      $.ajax({
        url: 'twitteroauth/Twitter.php',
        type: "POST",
        data: { Title: customs.results[i].title}
    }).done(function( msg ) {
          if(msg){
            document.getElementById(i+100).innerHTML = "-------------------------------------------------------<br>"+msg;
          }else{
            document.getElementById(i+100).innerHTML = "-------------------------------------------------------<br>No tweet found <br> -------------------------------------------------------";
          }
          T_h[i] = 0;
    });
}else{
  document.getElementById(i+100).innerHTML = "";
      T_h[i] = 1;
}

 }
  //this funtion will print and request a music data from index.php
 function spon(i){
document.getElementById(i).innerHTML = "";
if(S_h[i]==1){

     $.ajax({
       url: 'spotify/index.php',
       type: "POST",
       data: { Title: customs.results[i].title }
   }).done(function( msg ) {
     if(msg){
       document.getElementById(i).innerHTML = "<br>" + msg;
          }else{
       document.getElementById(i).innerHTML = "-------------------------------------------------------<br>No OST found <br> -------------------------------------------------------";
     }

       S_h[i] = 0;
   });

}else{
document.getElementById(i).innerHTML = "";
  S_h[i] = 1;
}

 }

 //this function will display a data such as movie video preview and button
 //for the button will create 2 button for twiiter and sposify
 //when clicked the twiiter and sposify will be request and display
function display(){

  var contents  = $('#content');
  contents.html('');
  for(i =0; i< customs.results.length;i++){

    if(customs.results[i].overview){
      var ov = "<b>Overview:</b> "+customs.results[i].overview;
    }else{
      var ov =  "No overview avaliable";
    }

    if(customs.results[i].poster_path!= null){
      var pPoster = Poster+customs.results[i].poster_path;
    }else{
      var pPoster = "Image/imageE.png";
    }

    if(videos[i].items[0]){
      if(videos[i].items[0].id.videoId){
        pVideo = '<p><b>Title:</b> '+ videos[i].items[0].snippet.title+'</p>'+
        '<p><b>URL:</b> https://youtube.com/embed/'+ videos[i].items[0].id.videoId+
        '<br><br><center><iframe width="200" height="200"src="https://www.youtube.com/embed/'+videos[i].items[0].id.videoId+'"></iframe></center>'
      }else{
        pVideo = 'No URL avaliable';
      }
    }else{
    continue;
    }

    let text =
    `<center>
      <div class="card" style="width: 37rem; ">
        <div class="card-body">
          <p class="card-text">
           <button type="button" class="btn btn-primary" onclick="tweet(${i})"><b>Tweet</b></button>
            &nbsp&nbsp <b>Title: ${customs.results[i].title} &nbsp&nbsp </b>
            <button type="button" class="btn btn-primary" onclick="spon(${i})"><b>OST</b></button></p>
           ${ov}
        </div>
          <table border="5" id="${i+200}">
          <tr>
            <th  rowspan="6" ><img class="card-img-bottom" src=" ${pPoster} " alt="Card image cap"></th>
          </tr>
          <tr>
            <td row>
              <h4>Video Preview</h4>
              ${pVideo}<br>
            </td>
          </tr>
          </table>
            <div>
            <div id="${i+100}">
          </div>
          <div>
            <div id="${i}">
            </div>
          </div>
        </div >
    </center>`
    contents.append(text)  //append the result to content
  }
  for (var i = 0; i < customs.results.length; i++){   //removing old data
    videos.shift();
  }


}
</script>
    <script src="Js/jquery-3.2.1.min.js">  </script>

  </body>
</html>
