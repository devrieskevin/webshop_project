<?php

require_once 'html_doc.php';

/**
 * Description of basic_doc
 *
 * @author Kevin de Vries
 */
class BasicDoc extends HtmlDoc {
  protected $model;

  public function __construct($model) {
    $this->model = $model;
  }

  protected function title() {
    echo '<title>Opdracht 4.3 - ' . $this->model->page . '</title>';
  }

  private   function metaAuthor() {
    echo '<meta name="author" content="Kevin de Vries"/>';
  }

  private   function metaViewport() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
  }

  private   function cssLinks() {
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"'
       . ' integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">';
  }
  private   function scriptLinks() {
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>';
    echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>';
  }

  private   function beginBodyHeader() {
    echo '<header class="d-none d-md-block text-center">' . PHP_EOL;
    echo '<h1>';
  }

  protected function bodyHeaderContent() {
    echo 'Page not found';
  }

  private   function endBodyHeader() {
    echo '</h1>' . PHP_EOL;
    echo '</header>' . PHP_EOL;
  }

  private   function bodyHeader() {
    $this->beginBodyHeader();
    $this->bodyHeaderContent();
    $this->endBodyHeader();
  }

  private   function mainMenuItem($target,$title) {
    $active = ($this->model->pageType == $target) ? ' active' : '';
    echo '<li class="nav-item">';
    echo '<a class="nav-link'.$active.'" href="index.php?page='.$target.'">'.$title.'</a>';
    echo '</li>';
  }

  private   function mainMenu() {
    echo '<nav class="navbar navbar-expand-md bg-primary navbar-dark">'
       . '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">'
       . '<span class="navbar-toggler-icon"></span>'
       . '</button>'
       . '<div class="collapse navbar-collapse" id="collapsibleNavbar">'
       . '<ul class="navbar-nav">';

    foreach ($this->model->menu as $key => $val) {
      $this->mainMenuItem($key,$val);
    }

    echo '</ul>'
       . '</div>'
       . '</nav>';
  }

  private   function mainAlert(){
    if (!empty($this->model->errors['main'])) {
      echo '<div class = "alert alert-info alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      echo $this->model->errors['main'];
      echo '</div>';
    }
  }

  protected function mainContent() {
    echo '<p>page ['.$this->model->page.'] not found</p>' . PHP_EOL;
  }

  private   function bodyFooter() {
    echo '<footer>' . PHP_EOL;
    echo '<p class="text-white text-right bg-dark"> &copy; 2020 Kevin de Vries </p>' . PHP_EOL;
    echo '</footer>' . PHP_EOL;
  }

  // Override function from htmlDoc
  protected function headerContent() {
    $this->title();
    $this->metaAuthor();
    $this->metaViewport();
    $this->cssLinks();
    $this->scriptLinks();
  }

  // Override function from htmlDoc
  protected function bodyContent() {
    echo '<div class="container text-secondary">';
    $this->bodyHeader();
    $this->mainMenu();
    $this->mainAlert();
    $this->mainContent();
    $this->bodyFooter();
    echo '</div>';
  }
}

?>
