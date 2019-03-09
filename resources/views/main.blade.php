@extends('layouts.master')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')


 <div  class="jumbotron py-3">
     <div class="d-flex mb-2">
        <image style="width:40px;height:40px;" src="/image/head.png">
        <h2 class="mb-0 ml-3" style="line-height:40px;">新着副音声</h2>
     </div>
   
    <table class="table table-borderless table-hover">
        <thead class="bg-gray border-bottom border-dark">
            <tr>
                <th scope="col" class="w-50">副音声タイトル</th>
         <th scope="col">投稿者名</th>
          <th scope="col">投稿日時</th>
          <th scope="col">再生回数</th>
          </tr>
          </thead>
        <tbody id="echo">      
    

        </tbody>
    </table>
</div>
   
<!--<script src="{{ secure_asset('js/api.js') }}" ></script>-->
<script>
newlist();
// ranking();

$('#newlist').on('click',function(){
    newlist();
});

$('#ranking').on('click',function(){
    ranking();
});


</script>



@endsection
