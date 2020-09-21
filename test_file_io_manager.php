<?php

require_once 'ifile_io_manager.php';

/**
 * Description of TestFileIOManager
 *
 * @author Kevin de Vries
 */
class TestFileIOManager implements IFileIOManager{
  public $uploadSucceeded; // To be set from the test itself during preperation
  public $fileSize; // To be set from the test itself during preperation
  public $isImage; // To be set from the test itself during preperation
  public $imageName; // To be set from the test itself during preperation

  public    function uploadSucceeded($name) {
    return $this->uploadSucceeded;
  }

  public    function uploadedFileSize($name) {
    return $this->fileSize;
  }

  public    function isUploadImage($name) {
    return $this->isImage;
  }

  public    function saveUploadedProductImage() {
    return 'images/products/' . $this->imageName;
  }

  // Saves an error message to the log file
  public    function saveToLog($message) {}

}
