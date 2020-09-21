<?php

require_once 'form_doc.php';

/**
 * Description of LoginDoc
 *
 * @author Kevin de Vries
 */
class LoginDoc extends FormDoc{
  public    function __construct($model) {
    parent::__construct($model);
  }

  // Override function from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Login';
  }

  // Override function from FormDoc
  protected function formFieldContent($name) {
    echo '<div class = "col-sm-3 col-md-2 col-xl-1">';
    $this->formFieldLabel($name);
    echo '</div>';

    echo '<div class = "col-sm-6">';
    $this->formFieldInput($name);
    echo '</div>';

    echo '<div class = "col-sm-3 col-md-4 col-xl-5 text-danger">';
    $this->formFieldError($name);
    echo '</div>';
  }
}

?>