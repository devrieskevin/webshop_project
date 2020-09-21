<?php

require_once 'basic_doc.php';

/**
 * Description of ContactReactionDoc
 *
 * @author Kevin de Vries
 */
class ContactReactionDoc extends BasicDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  private   function reactionLine($label,$name) {
    echo '<div>';
    echo $label . ': ' . $this->model->$name;
    echo '<div>';
  }

  // Override functions from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Contact';
  }

  protected function mainContent() {
    echo '<p>Bedankt voor uw reactie:</p>';
    $this->reactionLine('Naam', 'name');
    $this->reactionLine('Email', 'email');
    $this->reactionLine('Uw bericht', 'message');
  }
}

?>