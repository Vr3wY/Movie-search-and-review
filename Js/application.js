
const TMDbAPI = "???????????????????????????"
const GVAPI = '???????????????????????????'
const Poster = 'http://image.tmdb.org/t/p/w780'
var customs ;
var videos = [];
function request(){
var contents  = $('#content')
  var q = $('#text').val();
  if(q == ""){
  }else{

      contents.html('')
    $.get('https://api.themoviedb.org/3/search/movie',{ //get respond www. by sending a vedio requirment to get information
      api_key : TMDbAPI,
      query : q,
      page : 1,
      include_adult : "True"
    },search)
  }
  setTimeout(function(){
    display()
  }, 5000);
}

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
  //    videoCaption : "closedCaption",
      videoType : 'any',
      type : "video",
      maxResults : 1
    }, video)
  }


}

 function video(video){

   videos.push(video);


 }

function display(){

  var contents  = $('#content')

  for (var i = 0; i < customs.results.length; i++) {

    if(customs.results[i].poster_path!= null){
      var pPoster = Poster+customs.results[i].poster_path;
    }else{
      var pPoster = "imageE.png";
    }

    if(videos[i].items[0]){
      if(videos[i].items[0].id.videoId){
        pVideo = '<p>Title: '+ videos[i].items[0].snippet.title+'</p>'+
        '<p>URL: https://youtube.com/embed/'+ videos[i].items[0].id.videoId+
        '<br><br><iframe width="200" height="200"src="https://www.youtube.com/embed/'+videos[i].items[0].id.videoId+'"></iframe>'
      }else{
        pVideo = 'No URL avaliable';
      }
    }else{
    continue;
    }


    let text =
  `<center>
    <div class="card" style="width: 25rem; ">
        <div class="card-body">
          <p class="card-text">  Title: ${customs.results[i].title}</p>
        </div>
          <table border="5">
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
          <div >
          <div>
    </div>

</center>
          `
    contents.append(text)  //append the result to content

  }
  for (var i = 0; i < customs.results.length; i++) {
    videos.shift();
}

}
