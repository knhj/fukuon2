@extends('layouts.master')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')


<style>
.blink{animation:BLINK 1.0s ease-in-out infinite alternate;}
@keyframes BLINK {0%{opacity:1.0;}100% {opacity:0;}}
</style>

<!--<div  class=" row">-->
  <div  class="jumbotron py-3">
     <p id="title" class="lead"></p>
     
     <div class="d-flex">
       <div>
           <div class="mt-2 mr-5" id="player"></div>
           
            <h3 id="sublist">この動画に投稿された副音声一覧</h3>
             <table id="table_content" class="table table-borderless table-hover">
                <thead class="bg-gray border-bottom border-dark">
                <tr>
                <th scope="col" class="w-75">副音声タイトル</th>
                <th scope="col">投稿者名</th>
                </tr>
                </thead>
              <tbody>  

            @foreach ($item as $object)
            
          <tr>
           <td><a href="/part/{{$object->video_id}}/{{$object->fukuon_id}}">{{$object->fukuon_title}} </a></td>
           <td>{{$object->name}}</td>
          </tr>
            
            @endforeach
            </tbody>
           </table>
       </div>
       <div class="w-100">
          <form>
            <div class="form-group">
              <label for="name">投稿者名</label>
              <input type="name" class="form-control" id="name" placeholder="投稿者名を入力">
            </div>
            <div class="form-group">
              <label for="ftitle">副音声タイトル</label>
              <input type="ftitle" class="form-control" id="ftitle" placeholder="副音声タイトルを入力">
            </div>
             <div class="form-group">
              <label for="comment">コメント</label>
              <textarea type="comment" class="form-control" id="comment" rows="3" placeholder="コメントを入力"></textarea>
            </div>
          </form>
           <div class="row justify-content-center">
           <div id="recording" style="width:250px;" class="btn btn-lg btn-dark mb-2" role="button">副音声の録音を始める</div>
        </div>
        <div>録音時間：<span id="recordtime"></span></div>
        <div id="prog"></div>
        <div id="recordingslist" class="my-2 text-center"></div>
        <div id="log" class="my-2"></div>
        <div class="row justify-content-center">
           <div id="cast"></div>
        </div>
          
          
          
        </div>
        
      </div>
    </div>

<script  src="{{ secure_asset('/js/recorder.js') }}"></script>
<script  src="{{ secure_asset('/js/timeConvert.js') }}"></script>

<script>
// ifarame関係記述
var prog = document.getElementById('prog');
var prog_val = document.getElementById('prog_val');
var prog_total = document.getElementById('prog_total');
var sublist = document.getElementById('sublist');
var table_content = document.getElementById('table_content');

// const vid = "l9OM80zwoCU";
const vid = "{{$video_id}}";
var isset = "{{$item}}";
let vtime  = "";

var Title = document.getElementById('title');
var Recordtime = document.getElementById('recordtime');
var Recordingslist = document.getElementById('recordingslist');
var Log = document.getElementById('log');
// Title.innerHTML = vid;

if(isset =="[]"){ 
  sublist.textContent = "この動画に副音声は投稿されていません"; 
  table_content.innerHTML = "";
  }

YIdtoTotaltime(vid);

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
        // event.target.playVideo();
        // event.target.setVolume(0);
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
    // var done = false;
      function onPlayerStateChange(event) {
        // if (event.data == YT.PlayerState.PLAYING && !done) {
        //   setTimeout(stopVideo, 6000);
        //   done = true;
        // }
      }
      function stopVideo() {
        player.stopVideo();
      }
    


function YIdtoTotaltime(videoId){
    var ajax = new XMLHttpRequest();
    ajax.open("get", "https://www.googleapis.com/youtube/v3/videos?id="+ videoId +"&key=AIzaSyDujH8RbX5ji2m4lrCeZO9PziawwLxQCfk&part=snippet,contentDetails,statistics");
    ajax.responseType = 'json';
    ajax.send();
    ajax.onload = function (e) {
      
      Title.innerHTML = this.response.items[0].snippet.title;
      
      Recordtime.innerHTML = _convertDurationJapan(this.response.items[0].contentDetails.duration);
      vtime = _convertDuration(this.response.items[0].contentDetails.duration);
      
    };
}


</script>
<script>
// recorder関係
var Recording = document.getElementById('recording');
Recording.addEventListener('click', function(e) {
      // console.log(this)   
      
      player.setVolume(0);
      player.playVideo();
      Recording.classList.add("disabled");
      Recording.innerText = "録音中";
      Recording.classList.add("blink"); //blinkで点滅させる
      
      startRecording(this);
      
      var i = 1;
      var nowtime;
      
      var settimer = setInterval(function(){
        nowtime = vtime - i;
        prog.innerHTML = '録音中....あと'+nowtime +'秒';
        i++;
        if(nowtime == 0){
          clearInterval(settimer);
          prog.innerHTML = '録音は終了しました。';
        }
        
        
        }, 1000);
      
      
     setTimeout(function(){stopRecording(this)}, vtime*1000);
      // setTimeout(function(){stopRecording(this)}, 5000);
      
});


  var audio_context;
  var recorder;
  var formdata;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    recorder = new Recorder(input);
    prog.innerHTML = '録音の準備が完了しました。';
  }

  function startRecording(button) {
    recorder && recorder.record();
    
    Log.innerHTML = "";
  }

  function stopRecording(button) {
    recorder && recorder.stop();
     Recording.classList.toggle("blink");
 　　Recording.innerText = "録音終了";
 　
    // create WAV download link using audio data blob
    createDownloadLink();
    recorder.clear();
  }

  function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      var fname = vid + getdate();
      var wavname =  fname + ".wav";
      var mp3name = fname + ".mp3" ;
      
      var url = URL.createObjectURL(blob);
      // var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');
      // var div = document.createElement('div');
      var cast = document.getElementById('cast');
      
      cast.setAttribute('class', 'btn btn-lg btn-dark');
      cast.setAttribute('style', 'width:250px;');
      // div.setAttribute('id', 'cast');
      cast.innerHTML = "この副音声を投稿する";
      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = wavname ;
      hf.innerHTML = hf.download;
      
      Recordingslist.appendChild(au);
   
      
      cast.addEventListener('click', function(e) {
        var username = document.getElementById("name").value;
        var ftitle = document.getElementById("ftitle").value;
        var comment = document.getElementById("comment").value;
        
       postblob(blob,fname,wavname,mp3name,username,ftitle,comment,vid);
       cast.innerHTML = "アップロード中";
       cast.classList.add("disabled");
        
      });
      
      
      function postblob(blob,fname,wavname,mp3name,username,ftitle,comment,vid){
       //XMLHttpRequestによるアップロード処理 //
        formdata = new FormData();
        formdata.append('fname', fname);
        formdata.append('wavname', wavname);
        formdata.append('mp3name', mp3name);
         formdata.append('username', username);
         formdata.append('ftitle', ftitle);
         formdata.append('comment', comment);
         formdata.append('vid', vid);
         formdata.append('data', blob);
        
       
        var xhttpreq = new XMLHttpRequest();
        xhttpreq.onreadystatechange = function () {
          if (xhttpreq.readyState == 4 && xhttpreq.status == 200) { alert(xhttpreq.responseText); }
          if(xhttpreq.readyState == 4 && xhttpreq.status != 0) {
            cast.innerHTML = "アップロード完了";
          }
        };
        var token = document.getElementsByName('csrf-token').item(0).content; 
        console.log(token);
        xhttpreq.open("POST", "/access", true);
        xhttpreq.setRequestHeader('X-CSRF-Token', token); 
        xhttpreq.send(formdata);
      }
      
      
    });
  }

function getdate(){
  
   //日時取得
     let year,month, date, h, m, s;
        let now = new Date();
        year = now.getFullYear();
      
        if (now.getMonth() + 1 < 10) {
            month = "0" + now.getMonth() + 1;

        } else {
            month = now.getMonth() + 1; //+１を入れる。
        }

        if (now.getDate() < 10) {
            date = "0" + now.getDate();
        } else {
            date = now.getDate();
        }

        if (now.getHours() < 10) {
            h = "0" + now.getHours();
        } else {
            h = now.getHours();
        }

        if (now.getMinutes() < 10) {
            m = "0" + now.getMinutes();
        } else {
            m = now.getMinutes();
        }

        if (now.getSeconds() < 10) {
            s = "0" + now.getSeconds();
        } else {
            s = now.getSeconds();
        }

        return String(year) + String(month) + String(date) + String(h) + String(m) + String(s);
  
}


  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
      window.URL = window.URL || window.webkitURL;
      
      
      audio_context = new AudioContext;
     
    } catch (e) {
      alert('No web audio support in this browser!');
    }

    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      // __log('No live audio input: ' + e);
    });
  };




</script>



@endsection


