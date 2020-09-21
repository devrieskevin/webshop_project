<?php

require_once 'form_doc.php';

/**
 * Description of RegisterDoc
 *
 * @author Kevin de Vries
 */
class RegisterDoc extends FormDoc{
  public    function __construct($model) {
    parent::__construct($model);
  }

  // Override function from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Register';
  }

  // Override function from FormDoc
  protected function formFieldContent($name) {
    echo '<div class = "col-sm-3 col-md-2">';
    $this->formFieldLabel($name);
    echo '</div>';

    echo '<div class = "col-sm-6">';
    $this->formFieldInput($name);
    echo '</div>';

    echo '<div class = "col-sm-3 col-md-4 text-danger">';
    $this->formFieldError($name);
    echo '</div>';
  }

}

?>