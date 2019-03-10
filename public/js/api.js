
    // 登録する関数
   function storeData(){
       //
   }

   // 表示する関数:新着順
   function newlist(){
        var str = "";
        var ajax = new XMLHttpRequest();
        ajax.open("get", "/api/");
        ajax.responseType = 'json';
        ajax.send();
        ajax.onload = function (e) {
             console.log(e.target.response);
             var obj = e.target.response;
            //  console.log(obj.length);
             
             for(var i = 0; i < obj.length ; i++ ) {
            //   Object.keys(obj[i]).forEach(function (key) {
            //  console.log(key + "は" + obj[i][key] + "と鳴いた！");
             //   });
             
                  str += `<tr>
                             <td><a class="btn" id="${obj[i].fukuon_id}">${obj[i].fukuon_title}</a></td>
                             <td>${obj[i].name}</td>
                             <td>${obj[i].created_at}</td>
                             <td>${obj[i].play_count}</td>
                             </tr>
                             <script>
                             $('#${obj[i].fukuon_id}').on('click',function(){
                                  
                                location.href = 'part/${obj[i].video_id}/${obj[i].fukuon_id}';
                                 
                             });
                             </script>
                             
                             `;
             }
            //  console.log(str);
         $('#echo').html(str);
        }
   }
   
   
    // 表示する関数：再生回数が多い順
   function ranking(){
        var str = "";
        var ajax = new XMLHttpRequest();
        ajax.open("get", "/api/ranking");
        ajax.responseType = 'json';
        ajax.send();
        ajax.onload = function (e) {
             console.log(e.target.response);
             var obj = e.target.response;
            //  console.log(obj);
             for(var i = 0; i < obj.length ; i++ ) {
                  str += `<tr>
                             <td><a class="btn" id="${obj[i].fukuon_id}">${obj[i].fukuon_title}</a></td>
                             <td>${obj[i].name}</td>
                             <td>${obj[i].created_at}</td>
                             <td>${obj[i].play_count}</td>
                             </tr>
                              <script>
                             $('#${obj[i].fukuon_id}').on('click',function(){
                                 location.href = 'part/${obj[i].video_id}/${obj[i].fukuon_id}';
                             });
                             </script>
                             `;
             }
            //  console.log(str);
         $('#echo').html(str);
        }
   }
   
    //検索する関数
   function search(search_word){
       
        // const search_btn = document.getElementById("search_btn");
        const result = document.getElementById("result");
        // const input= document.getElementById("input");
        const setbtn = document.getElementById("setbtn");
        var pageToken = "";
        
        // console.log(search_word);
        var ajax = new XMLHttpRequest();
            ajax.open("get", 'https://www.googleapis.com/youtube/v3/search?part=snippet&videoDuration=short&type=video&maxResults=20&q=' + search_word + '&order=viewCount&key=AIzaSyDujH8RbX5ji2m4lrCeZO9PziawwLxQCfk');
            ajax.responseType = 'json';
            ajax.send();
            ajax.onload = function (e) {
            
              pageToken = this.response.nextPageToken;
             
             var tmp = '<div class="row my-5 border-bottom border-dark"><div class="col-10 pl-5" style="font-size:1.2em;" id="result_title">検索結果</div><div class="col-2 text-center" style="font-size:1.2em;" id="result_on">副音声投稿数</div></div>';
            
             var array = [];
              for (var i = 0; i < this.response.items.length; i++) {
                
                var videoid = this.response.items[i].id.videoId;
                var thmbnailurl = this.response.items[i].snippet.thumbnails.medium.url;
                var vtitle = this.response.items[i].snippet.title;
                array.push(videoid);
                
              tmp += '<div class="row mb-2 ">';
              tmp +=   '<a class="col-10" href="/part/'+ videoid +'">';
              tmp +=     '<div class="col-10 d-inline-flex flex-row" id="result_title">';
              tmp +=       '<img class="img-thumbnail" style="width:128px;height:72px" src="' + thmbnailurl + '">';
              tmp +=       '<div >'+vtitle+'</div>';
              tmp +=     '</div>';
              tmp +=   '</a>';
              tmp +=  '<div class="col-2 text-center" id="'+ videoid+'">';
              tmp +=  '</div>';
              tmp += '</div>';
            }
                
               setbtn.classList.add("btn");
               setbtn.classList.add("btn-outline-dark");
               setbtn.classList.add("btn-block");
               setbtn.innerHTML = "さらに読み込む...";
               result.innerHTML = tmp;
               
               for(let i = 0; i < array.length; i++) {
            //   console.log(array[i]);
               number_count(array[i]);
               }
               
               
               
            };
        
        // console.log("test");
        
        // });
        
        setbtn.addEventListener('click', function(e) {
            var ajax = new XMLHttpRequest();
            ajax.open("get", 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=20&q=' + search_word + '&order=viewCount&pageToken='+ pageToken +'&key=AIzaSyDujH8RbX5ji2m4lrCeZO9PziawwLxQCfk');
            ajax.responseType = 'json';
            ajax.send();
            ajax.onload = function (e) {
            // console.log(this);
            var tmp = "";
            pageToken = this.response.nextPageToken;
             var array = [];
              for (var i = 0; i < this.response.items.length; i++) {
             var videoid = this.response.items[i].id.videoId;
             var thmbnailurl = this.response.items[i].snippet.thumbnails.medium.url;
             var vtitle = this.response.items[i].snippet.title;
            array.push(videoid);
           
             
              tmp += '<div class="row mb-2 ">';
              tmp +=   '<a class="col-10" href="/part/'+ videoid +'">';
              tmp +=     '<div class="col-10 d-inline-flex flex-row" id="result_title">';
              tmp +=       '<img class="img-thumbnail" style="width:128px;height:72px" src="' + thmbnailurl + '">';
              tmp +=  '<div >'+vtitle+'</div>';
              tmp +=     '</div>';
              tmp +=   '</a>';
              tmp +=  '<div class="col-2 text-center" id="'+ videoid+'">';
              tmp +=  '</div>';
              tmp += '</div>';
             
            }
            
            result.insertAdjacentHTML('beforeend', tmp);
            
             for(let i = 0; i < array.length; i++) {
            //   console.log(array[i]);
               number_count(array[i]);
               
               }
            }
            
        });
        
        
        function number_count(vid){
            const getvid = document.getElementById(vid);
            var a = new XMLHttpRequest();
            a.open("get", "api/number/"+vid);
            a.responseType = 'json';
            a.send();
            a.onload = function (e) {
            //  console.log(e);
            //   console.log(e.currentTarget.response);
             getvid.innerHTML = e.currentTarget.response;
            }
            
        }
       
       
   }
   
   
   
   

   // 削除する関数
   function deleteData(id){
       //
   }

    
 // playとstoreは難しいため通常の画面遷移で対応
 
