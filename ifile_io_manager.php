<?php

/**
 *
 * @author Kevin de Vries
 */
interface IFileIOManager {

  function uploadSucceeded($name);

  function uploadedFileSize($name);

  function isUploadImage($name);

  function saveUploadedProductImage();

  // Saves an error message to the log file
  function saveToLog($message);
}
