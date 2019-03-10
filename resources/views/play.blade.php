@extends('layouts.master2')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')


  <div  class="jumbotron pt-3">
    <a id="title" class="lead d-block" href="" ></a>
      <div class="d-sm-flex d-flex-column">
        <div>
           <div class="mt-2 mr-5" id="player"></div>
           <div class="form-group d-flex rounded bg-dark text-white w-50 px-3 pt-2 mt-1">
             <label for="soundvalue" class="mr-3" >副音声音量</label>
             <input type="range" class="custom-range" style="width:200px;" id="soundvalue" min="0" max="1" step="0.001" value="1">
           </div>
      </div>
      <div class="w-100">
          <div>
           <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
         <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Ffukuon.lolipop.io%2Fpart%2F{{$item[0]->fukuon_id}}&layout=button&size=small&mobile_iframe=true&width=61&height=20&appId" width="61" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
         </div>
          <div class="rounded bg-secondary w-100 h-100">
          <div class=" bg-dark py-2 mt-1 text-center text-white" >副音声タイトル</div>
          
        <div class="text-white text-justify">{{$item[0]->fukuon_title}}</div>
         <div class="bg-dark py-2 mt-1 text-center text-white" >投稿者名</div>
         <div class="text-white text-justify">{{$item[0]->name}}</div>
         <div class="bg-dark py-2 mt-1 text-center text-white" >コメント</div>
           <div class="text-white text-justify">{!! nl2br(e($item[0]->fukuon_comment)) !!}</div>
       </div>
      </div>
     </div>
    
</div>
 <!--オーディオ関係。完成形は非表示にする-->
 <!--<audio id="audio" src=""  controls></audio>-->
 <audio id="audio" src=""  style="display:none;" controls></audio>



<script>

var Title = document.getElementById('title');
var audio = document.getElementById('audio');
var soundvalue =document.getElementById('soundvalue');

const vid = "{{$item[0]->video_id}}";
const fid = "{{$item[0]->fukuon_id}}";
var onetime = 1;  //再生回数を一回だけ回すためカウンター
var status ; //再生状態を管理する。再生中＝１、一時停止＝２、再生終了＝０

YIdtoTitle(vid);

var fukuon_src =  "";
fukuon_src +=  '/upload/';
fukuon_src +=  fid ;
fukuon_src += ".wav";

//autioタグの準備
audio.src = fukuon_src;
audio.load();


soundvalue.addEventListener('change', function(e) {
 audio.volume = soundvalue.value ;
 
});

      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '360',
          width: '640',
          videoId: vid,
          playerVars: {
          loop: 0, // ループしない
          controls: 1, // コントローラー表示
          autoplay: 0, // 自動再生オフ
          rel: 0,  // オススメ動画を表示させない
          showinfo: 0 ,// タイトル表示
          disablekb: 1 // キーボードでの操作をさせない
           },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
          
        });
        
      }



      // 4. The API will call this function when the video player is ready.
     function onPlayerReady(event) {
              
        setInterval(function(){
                audio.currentTime = player.getCurrentTime();
                  if(status == 1){ audio.play();}
                  else if(status == 2||status == 0){audio.pause();}
                }, 100);
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
    // var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && onetime == 1) {
        //ajaxで副音声の再生回数カウンターを一回回している。onetimeを1->2にすることにより複数回のクリックを防ぐ
           var xhttpreq = new XMLHttpRequest();
           xhttpreq.open("GET", "https://fukuon-dev2-knhj.c9users.io/api/play_count_add/"+fid);
           xhttpreq.send();
         
        //   console.log("add open!"+"/add/"+fid );
          onetime++;
        }
        
        console.log(event.data);
        //youtube再生の時event.data=1,一時停止がevent.data=2,再生終了がevent.data=0
        
        status = event.data;
        
      }
      
      function stopVideo() {
        player.stopVideo();
      }
    

function YIdtoTitle(videoId){
    var ajax = new XMLHttpRequest();
    ajax.open("get", "https://www.googleapis.com/youtube/v3/videos?id="+ videoId +"&key=AIzaSyDujH8RbX5ji2m4lrCeZO9PziawwLxQCfk&part=snippet,contentDetails,statistics");
    ajax.responseType = 'json';
    ajax.send();
    ajax.onload = function (e) {
      Title.innerHTML = this.response.items[0].snippet.title;
      Title.href = "/part/"+ videoId;
    };
}


</script>




@endsection


