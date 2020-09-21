<?php

require_once 'basic_doc.php';

/**
 * Description of form_doc
 *
 * @author Kevin de Vries
 */
abstract class FormDoc extends BasicDoc {
  public    function __construct($model) {
    parent::__construct($model);
  }

  private   function beginForm($file_input=false) {
    $file_encoding = $file_input ? 'enctype="multipart/form-data"' : '';
    echo '<form method="post" action="index.php" ' . $file_encoding . '>'
       . '<input type="hidden" name="page" value="' . $this->model->page . '">';
  }

  protected function beginFormField() {
    echo '<div class="form-group row">';
  }

  protected function formFieldLabel($key) {
    echo '<label for="' . $key . '" class = "col-form-label">';
    echo $this->model->meta[$key]['formLabel'] . ':';
    echo '</label>';
  }

  protected function formFieldInput($key) {
    $type = $this->model->meta[$key]['type'];
    switch ($type){
      case 'textarea':
        echo '<textarea class="form-control" id="' . $key . '" name="' . $key . '">'
           . $this->model->$key . '</textarea>';
        break;
      case 'price':
        echo '<input class="form-control" type="number" min="0.01" step="0.01" id="' . $key . '"'
           . ' name="' . $key . '" value="' . $this->model->$key . '">';
        break;
      case 'file':
        echo '<input class="form-control-file" type="file" id="' . $key . '" name="' . $key . '">';
        break;
      default:
        echo '<input class="form-control" type="' . $type . '" id="' . $key . '"'
           . ' name="' . $key . '" value="' . $this->model->$key . '">';
        break;
    }
  }

  protected function formFieldError($key) {
    echo '*' . Util::getArrayVal($this->model->errors,$key);
  }

  private   function endFormField() {
    echo '</div>';
  }

  private   function endForm() {
    echo '<div>
            <button type="submit" class = "btn btn-primary">'
       .    $this->model->submitText
       .    '</button>
          </div>
          </form>';
  }

  abstract protected function formFieldContent($key);

  protected function formField($key) {
    $this->beginFormField();
    $this->formFieldContent($key);
    $this->endFormField();
  }

  protected function hiddenFormField($key) {
    echo '<input type="hidden" name="' . $key . '"'
       . ' value="' . $this->model->$key . '">';
  }

  protected function formContent() {
    foreach (array_keys($this->model->meta) as $key) {
      if ($this->model->meta[$key]['type'] !== 'hidden') {
        $this->formField($key);
      }
      else {
        $this->hiddenFormField($key);
      }
    }
  }

  protected function form($file_input=false) {
    $this->beginForm($file_input);
    $this->formContent();
    $this->endForm();
  }

  // Override BasicDoc function
  protected function mainContent() {
    $this->form();
  }
}

?>