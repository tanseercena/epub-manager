<?php
require_once __DIR__ . "/../config/init.php";
if ($_GET["file_id"]) {
  $book_file = new BookFile();
  $book_file->find($_GET["file_id"]);
  if($book_file->filename){
    $file = $book_file->filename;
    $book_id = $book_file->book_id;
    $book = new Book();
    $book->find($book_id);
    $isbn = $book->isbn;
  }else{
    echo "Epub File not found.";
  }
}else{
  echo "Epub File not found.";
  exit;
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Epub Viewer</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
  <script src="<?php echo $base_url; ?>assets/js/epub.min.js"></script>

  <!-- <script>
  window.hypothesisConfig = function () {
    return {
      // constructor: this.Annotator.Sidebar,
      app: 'https://hypothes.is/app.html',
    };
  };
  </script> -->

  <script type="text/javascript">
    window.hypothesisConfig = function () {
      return {
        openSidebar: false,
        enableMultiFrameSupport: true,
        onLayoutChange: function(state) {
          var main = document.querySelector('#main');
          if (state.expanded === true) {
            main.classList.add("open");
          } else {
            main.classList.remove("open");
          }
        }
      };
    };
  </script>
  <script src="https://cdn.hypothes.is/hypothesis"></script>

  <style type="text/css">
    body {
      margin: 0;
      background: #fafafa;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #333;
    }

    #navigation {
      width: 300px;
      position: absolute;
      overflow: auto;
      top: 60px;
      left: 1000px
    }

    #navigation.fixed {
      position: fixed;
    }

    #navigation h1 {
      width: 200px;
      font-size: 16px;
      font-weight: normal;
      color: #777;
      margin-bottom: 10px;
    }

    #navigation h2 {
      font-size: 14px;
      font-weight: normal;
      color: #B0B0B0;
      margin-bottom: 20px;
    }

    #navigation ul {
      padding-left: 18px;
      margin-left: 0;
    }

    #navigation ul li {
      list-style: decimal;
      margin-bottom: 10px;
      color: #cccddd;
      font-size: 12px;
      padding-left: 0;
      margin-left: 0;
    }

    #navigation ul li a {
      color: #ccc;
      text-decoration: none;
    }

    #navigation ul li a:hover {
      color: #777;
      text-decoration: underline;
    }

    #navigation ul li a.active {
      color: #000;
    }

    #viewer {
      overflow: hidden;
      width: 620px;
      margin: 0 50px;
      /*background: url('ajax-loader.gif') center center no-repeat;*/
      background-color: white;
      box-shadow: 0 0 4px #ccc;
      margin: 20px;
      padding: 40px 80px;
    }

    #main {
      position: absolute;
      top: 50px;
      left: 100px;
      width: 800px;
      z-index: 2;
      transition: left .15s cubic-bezier(.55, 0, .2, .8) .08s;
    }

    #main.open {
      left: 0;
    }

    #pagination {
      text-align: center;
      margin: 20px;
      /*padding: 0 50px;*/
    }

    .arrow {
      margin: 14px;
      display: inline-block;
      text-align: center;
      text-decoration: none;
      color: #ccc;
    }

    .arrow:hover {
      color: #777;
    }

    .arrow:active {
      color: #000;
    }

    #prev {
      float: left;
    }

    #next {
      float: right;
    }

    #toc {
      display: block;
      margin: 10px auto;
    }

    #hypothesis-custom {
      overflow: hidden;
      /*position: absolute;*/
      right: 0;
      /*top: 0;*/
      height: 100%;
      width: 200px;
      /*z-index: -2;*/
    }

    #hypothesis-custom iframe {
      position: absolute;
      width: 100%;
      height: 100%;
    }
    #toc{
      max-height: 500px;
    }
  </style>
</head>
<body>
  <div id="navigation">
    <h1 id="title">...</h1>
    <image id="cover" width="150px"/>
    <h2 id="author">...</h2>
    <ul id="toc"></ul>
  </div>
  <div id="main">
    <div id="pagination">
      <a id="prev" href="#prev" class="arrow">...</a>
      <a id="next" href="#next" class="arrow">...</a>
    </div>
    <div id="viewer"></div>
  </div>

  <script>
    // Load the opf
    var params = URLSearchParams && new URLSearchParams(document.location.search.substring(1));
    //var url = params && params.get("url") && decodeURIComponent(params.get("url"));
    var url = "<?php echo $base_url; ?>assets/epub_files/<?php echo $isbn; ?>/<?php echo $file; ?>";

    // Load the opf
    var book = ePub(url);
    var rendition = book.renderTo("viewer", {
      flow: "scrolled-doc",
      ignoreClass: "annotator-hl"
    });

    // var hash = window.location.hash.slice(2);
    var loc = window.location.href.indexOf("?loc=");
    if (loc > -1) {
      var href =  window.location.href.slice(loc + 5);
      var hash = decodeURIComponent(href);
    }
    rendition.display(hash || undefined);


    var next = document.getElementById("next");
    next.addEventListener("click", function(e){
      window.scrollTo(0,0);
      rendition.next();
      e.preventDefault();
    }, false);

    var prev = document.getElementById("prev");
    prev.addEventListener("click", function(e){
      window.scrollTo(0,0);
      rendition.prev();
      e.preventDefault();
    }, false);

    rendition.on("rendered", function(section){
      var nextSection = section.next();
      var prevSection = section.prev();

      if(nextSection) {
        nextNav = book.navigation.get(nextSection.href);

        if(nextNav) {
          nextLabel = nextNav.label;
        } else {
          nextLabel = "next";
        }

        next.textContent = nextLabel + " »";
      } else {
        next.textContent = "";
      }

      if(prevSection) {
        prevNav = book.navigation.get(prevSection.href);

        if(prevNav) {
          prevLabel = prevNav.label;
        } else {
          prevLabel = "previous";
        }

        prev.textContent = "« " + prevLabel;
      } else {
        prev.textContent = "";
      }

      var old = document.querySelectorAll('.active');
      Array.prototype.slice.call(old, 0).forEach(function (link) {
        link.classList.remove("active");
      })

      var active = document.querySelector('a[href="'+section.href+'"]');
      if (active) {
        active.classList.add("active");
      }
      // Add CFI fragment to the history
      history.pushState({}, '', "?loc=" + encodeURIComponent(section.href));
      // window.location.hash = "#/"+section.href
    });

    book.loaded.navigation.then(function(toc){
      var $nav = document.getElementById("toc"),
          docfrag = document.createDocumentFragment();

      toc.forEach(function(chapter, index) {
        var item = document.createElement("li");
        var link = document.createElement("a");
        link.id = "chap-" + chapter.id;
        link.textContent = chapter.label;
        link.href = chapter.href;
        item.appendChild(link);
        docfrag.appendChild(item);

        link.onclick = function(){
          var url = link.getAttribute("href");
          console.log(url)
          rendition.display(url);
          return false;
        };

      });

      $nav.appendChild(docfrag);


    });

    book.loaded.metadata.then(function(meta){
      var $title = document.getElementById("title");
      var $author = document.getElementById("author");
      var $cover = document.getElementById("cover");
      var $nav = document.getElementById('navigation');

      $title.textContent = meta.title;
      $author.textContent = meta.creator;
      if (book.archive) {
        book.archive.createUrl(book.cover)
          .then(function (url) {
            $cover.src = url;
          })
      } else {
        $cover.src = book.cover;
      }

      if ($nav.offsetHeight + 60 < window.innerHeight) {
        $nav.classList.add("fixed");
      }

    });

    function checkForAnnotator(cb, w) {
     if (!w) {
       w = window;
     }
     setTimeout(function () {
        if (w && w.annotator) {
          cb();
        } else {
          checkForAnnotator(cb, w);
        }
      }, 100);
    }

    book.rendition.hooks.content.register(function(contents, view) {

        checkForAnnotator(function () {

          var annotator = contents.window.annotator;

          contents.window.addEventListener('scrolltorange', function (e) {
            var range = e.detail;
            var cfi = new ePub.CFI(range, contents.cfiBase).toString();
            if (cfi) {
              book.rendition.display(cfi);
            }
            e.preventDefault();
          });


          annotator.on("highlightClick", function (annotation) {
            console.log(annotation);
            window.annotator.show();
          })

          annotator.on("beforeAnnotationCreated", function (annotation) {
            console.log(annotation);
            window.annotator.show();
          })

        }, contents.window);

    });
  </script>

</body>
</html>
