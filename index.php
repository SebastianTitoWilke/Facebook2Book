<!DOCTYPE html>
<html>
<head>
  <title>Wilke Designs - Facebook2Book</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    #app > div {
      display: block;
      padding: 10px;
      background-color: #fff;
    }

    input, select {
        padding: 5px;
        margin: 5px;
        border: 1px solid #000;
        border-radius: 10px;
    }

    label {
        padding: 5px;
        margin: 5px;  
    }

    .unifrakturcook-bold {
      /* font-family: "UnifrakturCook", cursive;
      font-weight: 700;
      font-style: normal; */
    }

    [class^="col-"], .chapter {
      border-radius: 5px;
      border: 2px solid #000;
      padding: 5px;
    }

    .bookMakerButtonClose {
       float: right; 
       border-radius: 5px; 
       border: 2px solid black; 
       background-color: black;
       color: white;
       padding: 5px;
       margin: 5px;
    }

    .btn-primary {
       border-radius: 5px; 
       border: 2px solid black; 
       background-color: black;
       color: white;
       padding: 5px;
       margin: 5px;
    }

    .btn-primary:hover, .btn-primary:focus {
       border-radius: 5px; 
       border: 2px solid black; 
       background-color: #444;
       color: white;
       padding: 5px;
       margin: 5px;
    }

    .ui-loader {
      display: none;
    }

    .text, .chapter-content {
      border-radius: 5px;
      border: 2px solid #000;
      padding: 5px;
    }

    .chapter-text-element-frame {
      border-radius: 5px;
      border: 2px solid #000;
      padding: 5px;
      float: left;
      background-color: black;
      color: white;
    }

    .chapter-element-time {
      float: left;
    }

    .delete-chapter-text-element {
      float: right;
      padding: 0px;
      margin: 0px;
      margin-right: 5px;
      background-color: #333;
    }

    .delete-chapter-text-element:hover {
      float: right;
      padding: 0px;
      margin: 0px;
      margin-right: 5px;
      background-color: #555;
    }

    .text-container, .book-container, .book-output, .chapter-content {
      position: relative;
      overflow-y: scroll;
      max-height: 700px;
    }

    .text {
      max-width: 500px;
      max-height: 500px;
      overflow: hidden;
      overflow-y: scroll;
    }
    
    h3 {
      font-size: 16pt;
      font-weight: bold;
    }

    h6 {
      font-size: 14pt;
      font-weight: bold;
    }

    p {
      font-size: 12pt;
    }

    .chapter-element-text {
      position: relative;
      padding: 2px;
      margin: 25px 5px;
      background-color: #ccc;
    }


  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js" integrity="sha256-u0L8aA6Ev3bY2HI4y0CAyr9H8FRWgX4hZ9+K7C2nzdc=" crossorigin="anonymous"></script>  
</head>
<body class="unifrakturcook-bold">
    <div id="app">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">  
              <input Placeholder="Regex" id="regex" value="" type="text" v-model="regex" v-on:change="getData">
              <input Placeholder="Regex2" id="regex2" value="" type="text" v-model="regex2" v-on:change="getData">
              <input Placeholder="Contra-Regex" value="" id="contra" type="text" v-model="contra" v-on:change="getData">
              <input Placeholder="mintextlength" value="" id="mintextlength" type="number" v-model="mintextlength" v-on:change="getData">
              <input Placeholder="maxtextlength" value="" id="maxtextlength" type="number" v-model="maxtextlength" v-on:change="getData">
              <input Placeholder="from" id="from" value="" type="date" v-model="from" v-on:change="getData">
              <input Placeholder="until" id="until" value="" type="date" v-model="until" v-on:change="getData">
              <label>umgekehrt</label>
              <input Placeholder="Umgekehrt" id="umgekehrt" type="checkbox" v-model="umgekehrt" v-on:change="getData">
              <label>FileUpload</label>
              <input Placeholder="FileUpload" id="upload" type="file">
              <button class="btn btn-primary saveFile" v-on:click="saveJSONFile">Save Facebook-JSON</button> 
              <input Placeholder="Bookname" id="name" type="text" v-model="name">
              <button class="btn btn-primary speichern" v-on:click="saveData">Save</button> 
              <select v-model="bookJson" v-on:change="loadData">
                <option disabled value="">Auswahl</option>
                <?php
                      $files = scandir("bookMakerSpeicher");  
                      for($n = 2; $n < sizeof($files); $n++ ) {
                          echo '<option value="'.$files[$n].'">'.$files[$n].'</option>'; 
                      } 
                ?>      
              </select> 
          </div>
        </div>
        <div class="row">
            <div class="col-md-4">                    
              <div class="text-container">
                <div v-for="(x, index) in data"><center><h3>{{index}}</h3></center><div class="text" :data-time="x.time"><button class="btn btn-primary dragg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707"/></svg></button><div class="text-content" v-html="x.text" style="font-size: 12pt; margin-bottom: 20px;"></div></div></div> 
              </div>
            </div>          
            <div class="col-md-4">
              <button class="btn btn-primary create-chapter">Kapitel hinzufügen</button><button class="btn btn-primary create-print">Buch erzeugen</button><br>
              <div class="book-container">
              </div>
            </div>
            <div class="col-md-4">
              <div class="book-output">
              </div>
            </div>

      </div>
    </div>  
      <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
      <script>

                  
          $(document).ready(function() {

            //vue.js
            const app = Vue.createApp({
            data() {
              return {
                data: '',
                regex: 'Philosophie',
                regex2: ' ',
                from: '2010-01-01',
                until: '2026-01-01',
                mintextlength: 0,
                maxtextlength: 5000
              }
            },
            methods: {
              getData: function () {
                  var textTimesObject = $('.book-container').find('.chapter-element-time');
                  var times = [];
                  textTimesObject.each(function(index) {
                  times.push($(this).html());
                  });				  
                  fetch(`getFullJSONs.php?regex=`+this.regex+`&regex2=`+this.regex2+`&contra=`+this.contra+`&from=`+this.from+`&until=`+this.until+`&umgekehrt=`+this.umgekehrt+'&mintextlength='+this.mintextlength+'&maxtextlength='+this.maxtextlength+'&texteeimer='+JSON.stringify(times))
                  .then(res => res.json())
                  .then(res => {
                      this.data = res;
                  }); 
              },
              saveJSONFile: function () {
                var file_data = $("#upload").prop("files")[0];   
                var form_data = new FormData();
                form_data.append("file", file_data);
                    $.ajax({
                      url: 'saveJSON.php', // <-- point to server-side PHP script 
                      dataType: 'JSON',  // <-- what to expect back from the PHP script, if anything
                      cache: false,
                      contentType: false,
                      processData: false,
                      data: form_data,                         
                      type: 'post',
                      success: function(v){
                        if(v.antwort !== undefined && v.antwort == 1)  
                        alert('Uploaded'); // <-- display response from the PHP script, if any
                      }
                  });
              },
              saveData: function () {
                  var chapters = $('.book-container').html();
                  /*fetch(`saveAsBookJSON.php?regex=`+this.regex+`&regex2=`+this.regex2+`&contra=`+this.contra+`&from=`+this.from+`&until=`+this.until+`&umgekehrt=`+this.umgekehrt+'&mintextlength='+this.mintextlength+'&maxtextlength='+this.maxtextlength+'&name='+this.name+'&chapters='+JSON.stringify(chapters))
                  .then(res => res.json())
                  .then(res => {
                      if(res.antwort == 1) {
                          alert('gespeichert');
                      }
                  }); 
                  */
                 $.ajax({
                  url: 'saveAsBookJSON.php',
                  dataType: 'application/json',
                  type: 'post',
                  data: {
                    regex: this.regex,
                    regex2: this.regex2,
                    contra: this.contra,
                    from: this.from,
                    until: this.until,
                    umgekehrt: this.umgekehrt,
                    mintextlength: this.mintextlength,
                    maxtextlength: this.maxtextlength,
                    name: this.name,
                    chapters: escape(chapters)
                  },
                  proccessData: false, // this is true by default
                  success: function(res) {
                    if(res.antwort == 1) {
                      alert('gespeichert');
                    }
                  }
                 });
              },
              loadData: function () {
                  fetch(`loadBookJSON.php?bookJson=`+this.bookJson)
                  .then(res => res.json())
                  .then(res => {
                      if(res.antwort == 1) {
                          var inputs = res.json;
                          this.regex = inputs.regex;
                          this.regex2 = inputs.regex2;
                          this.contra = inputs.contra;
                          this.from = inputs.from;
                          this.until = inputs.until;
                          this.mintextlength = inputs.mintextlength;
                          this.maxtextlength = inputs.maxtextlength;
                          this.umgekehrt = inputs.umgekehrt;
                          this.name = this.bookJson.substr(0, this.bookJson.length-5);                          
                          if(inputs.chapters !== undefined) {
                            $('.book-container').html(unescape(inputs.chapters));
                            $('.create-print').trigger('click');
                          } else {
                            $('.book-container').html('');
                          }                             
                          fetch(`getFullMorbusJSONs.php?regex=`+inputs.regex+`&regex2=`+inputs.regex2+`&contra=`+inputs.contra+`&from=`+inputs.from+`&until=`+inputs.until+`&umgekehrt=`+inputs.umgekehrt+'&mintextlength='+inputs.mintextlength+'&maxtextlength='+inputs.maxtextlength)
                          .then(res => res.json())
                          .then(res => {
                              this.data = res;
                          }); 
                      } 
                  }); 
              }
            }
          })
          app.mount('#app');
		  
            $('.create-chapter').click(function(){
			  if($('.chapter') !== undefined) {
				var chapterCNT = $('.chapter').lenght;
			  } else {
				  var chapterCNT = 0;
			  }
              $('.book-container').append('<div id="chapter'+chapterCNT+'" class="chapter"><button class="btn btn-primary create-text">Create Text</button><button class="bookMakerButtonClose delete-chapter">X</button><input style="margin-left: 0px;" class="form-control chapter-name" value="" Placeholder="Chaptername" type="text"><div style="min-height: 400px; min-width: 100%;" class="chapter-content"></div><div>');			  
			  //$('#chapter'+chapterCNT).find('.chapter-content').sortable();
			});
            $('.book-container').on('click', '.delete-chapter', function(){
              $(this).parent().remove();
            }); 
            $('.book-container').on('keyup', '.chapter-name', function(){
              $(this).attr('value', $(this).val());
            }); 
            $('.text-container').on('click', '.text', function(){
                $(this).draggable({
                  revert: "invalid",
                  cursor: "move",
                  helper: 'clone',
                  appendTo: 'body',
                  containment: 'window',
                  scroll: false,
                });
            });
            $('.book-container').on('mouseover', '.chapter-content', function(){
              var dropzone = $(this);
              $(this).droppable({
                drop: function( event, ui ) {
                   var draggable = ui.draggable;
                   var dragged = draggable.clone();
                   var time = dragged.attr('data-time');
                   var text = dragged.find('.text-content').html();
                   dropzone.append('<div style="width: 100%;" class="chapter-text-element-frame" data-id="'+time+'"><div class="chapter-element-time">'+time+'</div><div style="display: none;" class="chapter-element-text">'+text+'</div><button class="btn btn-primary delete-chapter-text-element">X</button></div>');
                   draggable.remove();
                }
              });
            });
            $('.book-container').on('click', '.delete-chapter-text-element', function(){
              $(this).parent().remove();
            });
			$('.book-container').on('click', '.create-text', function(){
                var time = Math.round((new Date().getTime())/1000);
				var dropzone = $(this).closest('.chapter').find('.chapter-content');
				dropzone.append('<div style="width: 100%;" class="chapter-text-element-frame" data-id="'+time+'"><div class="chapter-element-time">'+time+'</div><div style="display: none;" class="chapter-element-text"></div><button class="btn btn-primary delete-chapter-text-element">X</button></div>');
            });
            $('.book-container').on('click', '.chapter-element-time', function() {
                $(this).parent().find('.chapter-element-text').toggle().attr('contenteditable','true' );
            });
            $('.create-print').click(function(){
              var outputChapters = $('.book-container').find('.chapter');
              var output = '';
              outputChapters.each(function(i) {
                  var chaptersNumber = i+1;
                  var chapterName = $(this).find('.chapter-name');
                  output += '<center><h3>Kapitel '+chaptersNumber+' - '+chapterName.val()+'</h3></center>';
                  var chapterContents = $(this).find('.chapter-text-element-frame');
                  chapterContents.each(function(chapterTextIndex) {
                    var singelChapterText = $(this).find('.chapter-element-text');
                    output += '<h6><center>'+chapterTextIndex+'.</h6></center>';
                    output += '<p style="text-align: justify; text-justify: inter-word;">'+singelChapterText.html()+'</p><br>';
                  });
                    output += '<br><br>';
              });  
              $('.book-output').html(output);       
            });
          });

      </script>
</body>
</html>