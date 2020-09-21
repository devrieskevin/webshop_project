<?php

require_once 'ifile_io_manager.php';

/**
 * Description of FileIOManager
 *
 * @author Kevin de Vries
 */
class FileIOManager implements IFileIOManager {

  public    function uploadSucceeded($name) {
    if (!isset($_FILES[$name])) {
      return false;
    }

    return $_FILES[$name]['error'] === UPLOAD_ERR_OK;
  }

  public    function uploadedFileSize($name) {
    return $_FILES[$name]['size'];
  }

  public    function isUploadImage($name) {
    return (bool)getimagesize($_FILES[$name]['tmp_name']);
  }

  public    function saveUploadedProductImage() {
    $target_dir = 'images/products/';
    $target_file = $target_dir . $_FILES['image']['name'];
    $uploadSuccess = move_uploaded_file($_FILES['image']["tmp_name"], $target_file);
    if (!$uploadSuccess) {
      throw new Exception('Could not save uploaded file to target directory');
    }
    return $target_file;
  }

  // Saves an error message to the log file
  public    function saveToLog($message) {
    try {
      $logfile = $this->openLogFile('a');
      try {
        $writeSuccess = fwrite($logfile,$message . PHP_EOL);
        if (!$writeSuccess) {
            throw new Exception('Could not write to the log file');
        }
      }
      catch (Exception $e2) {
        // Echoes exception, since writing to log already failed
        echo $e2->getMessage();
      }
      finally {
        fclose($logfile);
      }
    }
    catch (Exception $e) {
        // Echoes exception, since writing to log already failed
        echo $e->getMessage();
    }
  }

  /* Opens the users file with path users/users.txt
   * @params
   *   $filename - path to target file
   *   $mode - the mode with which the file is opened
   * @throws Exception when opening the file fails
   */
  private   function openFile($filename,$mode) {
    $file = fopen($filename,$mode);
    if (!$file) {
      throw new Exception('Could not open file ' . $filename . ' with mode ' . $mode);
    }
    return $file;
  }

  private   function openLogFile($mode) {
    $filename = 'log/php.log';
    return $this->openFile($filename,$mode);
  }

}

?>