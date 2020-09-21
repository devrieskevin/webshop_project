<?php

require_once 'form_doc.php';

/**
 * Description of ContactDoc
 *
 * @author Kevin de Vries
 */
class ContactDoc extends FormDoc{
  public    function __construct($myData) {
    parent::__construct($myData);
  }

  // Override function from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Contact';
  }

  // Override function from FormDoc
  protected function formFieldContent($name) {
    echo '<div class = "col-sm-2 col-md-1">';
    $this->formFieldLabel($name);
    echo '</div>';

    echo '<div class = "col-sm-6">';
    $this->formFieldInput($name);
    echo '</div>';

    echo '<div class = "col-sm-4 col-md-5 text-danger">';
    $this->formFieldError($name);
    echo '</div>';
  }

}

?>