<?php

/**
 * Description of HtmlDoc
 *
 * @author Kevin de Vries
 */
class HtmlDoc {
  private   function beginDoc() {
    echo '<!doctype html>' . PHP_EOL . '<html>' . PHP_EOL;
  }
  private   function beginHeader() {
    echo '<head>' . PHP_EOL;
  }
  protected function headerContent() {
    echo '<title>Root HTML page</title>' . PHP_EOL;
  }
  private   function endHeader() {
    echo '</head>' . PHP_EOL;
  }
  private   function beginBody() {
    echo '<body>' . PHP_EOL;
  }
  protected function bodyContent() {
    echo '<h1>Root HTML class</h1>' . PHP_EOL;
  }
  private   function endBody() {
    echo '</body>' . PHP_EOL;
  }
  private   function endDoc() {
    echo '</html>' . PHP_EOL;
  }

  public    function show() {
      $this->beginDoc();
      $this->beginHeader();
      $this->headerContent();
      $this->endHeader();
      $this->beginBody();
      $this->bodyContent();
      $this->endBody();
      $this->endDoc();
  }
}

?>