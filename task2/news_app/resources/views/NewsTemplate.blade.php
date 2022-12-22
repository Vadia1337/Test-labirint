<!DOCTYPE html>
<html style="font-size: 16px;" lang="ru"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>NEWS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/np.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" media="screen">
  </head>
  <body class="u-body u-xl-mode" data-lang="ru">

  @if (isset($action) && $action == 'create')
    <section class="u-clearfix u-section-1" id="carousel_0c06">
      <div class="u-clearfix u-sheet u-valign-top-xs u-sheet-1">
        <img class="u-expanded-width-xs u-image u-image-contain u-image-default u-image-1" src="{{ asset('assets/imgs/Untitled-1.png') }}" alt="" data-image-width="422" data-image-height="300">
        <div class="u-form u-form-1">
          <form class="u-clearfix u-form-spacing-20 u-form-vertical u-inner-form" style="padding: 0px;" name="form">
            <div class="u-form-address u-form-group u-label-none u-form-group-1">
              <input type="text" placeholder="Заполните заголовок" id="form-header" class="u-grey-5 u-input u-input-rectangle u-radius-20 u-input-1">
            </div>
            <div class="u-form-group u-label-none u-form-group-2">
              <input type="text" id="form-preview" class="u-grey-5 u-input u-input-rectangle u-radius-20 u-input-2" placeholder="Анонс">
            </div>
            <div class="u-form-group u-label-none u-form-group-3">
              <input type="text" placeholder="Заполните теги" id="form-tags" class="u-grey-5 u-input u-input-rectangle u-radius-20 u-input-3">
            </div>
            <div class="u-form-group u-form-message u-label-none">
              <textarea id="form-text" placeholder="Текст" rows="4" cols="50" id="message-319a" name="message" class="u-grey-5 u-input u-input-rectangle u-radius-20 u-input-4" required=""></textarea>
            </div>
            <div class="u-align-left u-form-group u-form-submit u-label-none">
              <a id="createnews" class="u-active-white u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-light-1 u-radius-50 u-btn-1">Отправить</a>
            </div>
            <div id="errors"> </div>
          </form>
        </div>
      </div>
    </section>
   @endif 
   @if (isset($action) && isset($news) && $action == 'shownews')
    <section class="u-align-center u-clearfix u-section-2" id="sec-4ec9">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-align-left u-container-style u-grey-5 u-group u-radius-42 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1"><span class="u-file-icon u-icon u-icon-1"><img src="{{ asset('assets/imgs/2540832.png') }}" alt=""></span>
            <h2 class="u-align-center u-text u-text-default u-text-1">{{ $news->getHeader(); }}</h2>
            <p class="u-align-center u-text u-text-2">{{ $news->getPreview(); }}</p>
            <p class="u-align-center u-text u-text-3">{{ $news->getText(); }}</p>
            <p class="u-align-center u-text u-text-palette-1-dark-1 u-text-4">{{ $news->getTags(); }}</p>
            <p class="u-align-center u-text u-text-palette-1-dark-1 u-text-4">{{ $news->getDate(); }}</p>
          </div>
        </div>
      </div>
    </section>
   @endif 
   @if (isset($action) && $action == 'deletenews')
    <section class="u-align-center u-clearfix u-section-3" id="carousel_93d5">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-align-left u-container-style u-grey-5 u-group u-radius-42 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1"><span class="u-file-icon u-icon u-icon-1"><img src="{{ asset('assets/imgs/3221897.png') }}" alt=""></span>
            <h2 class="u-align-center u-text u-text-default u-text-1"> Новость была удалена</h2>
          </div>
        </div>
      </div>
    </section>
   @endif 
    
   <script src="{{ asset('assets/main.js') }}"></script>

  </body>
</html>
