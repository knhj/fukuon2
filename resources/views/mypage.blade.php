@extends('layouts.master')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')

<!---->
 
<div id="mypage" class="jumbotron py-3">
     <div class="d-flex mb-2">
        <h2 class="mb-0 ml-3" style="line-height:40px;">投稿済みの副音声</h2>
     </div>
   
    <table class="table table-borderless table-hover">
        <thead class="bg-gray border-bottom border-dark">
            <tr>
                <th scope="col" class="w-50">副音声タイトル</th>
        　 <th scope="col"></th>
          <th scope="col">投稿日時</th>
          <th scope="col">再生回数</th>
          </tr>
          </thead>
        <tbody id="echo3">      
    

        </tbody>
    </table>
</div>

<!---->

<script>
    
//  mypage();   
     var str = "";
        var ajax = new XMLHttpRequest();
        ajax.open("get", "/api/mypage");
        ajax.responseType = 'json';
        ajax.send();
        ajax.onload = function (e) {
             console.log(e.target.response);
             var obj = e.target.response;
             console.log(obj);
             
             for(var i = 0; i < obj.length ; i++ ) {
             
                  str += `<tr>
                             <td><a class="btn" id="${obj[i].fukuon_id}">${obj[i].fukuon_title}</a></td>
                             <td> <button id="${obj[i].id}" class="btn btn-danger">削除</button></td>
                             <td>${obj[i].created_at}</td>
                             <td>${obj[i].play_count}</td>
                             </tr>
                             <script>
                             $('#${obj[i].fukuon_id}').on('click',function(){
                                  
                                location.href = 'part/${obj[i].video_id}/${obj[i].fukuon_id}';
                                 
                             });
                             
                              $('#${obj[i].id}').on('click',function(){
                                     var ajax = new XMLHttpRequest();
                                            ajax.open("get", "/api/delete/${obj[i].id}");
                                            ajax.send();
                                            ajax.onload = function (e) {
                                                location.href = '/mypage'; 
                                            }
                                 
                             });
                             <\/script>
                             
                             `;
             }
          console.log(str);
         $('#echo3').html(str);
        }
    
    
    
</script>

@endsection