<?php

namespace backend\libraries;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use yii\base\ErrorException;
use yii\web\UploadedFile;


/**
* Statuses
*/
class UploadManager 
{



    /**
     * validate the file content before uploading
     * @param $uploads
     * @return array  
     */
    public static function validateFile($uploads) {
		
		 
		if($uploads == null){ return ['status'=>false, 'status_message'=> 'please add an image file']; } else {$size = $uploads->size;}

		if($size >= 3000000 ){ return ['status'=>false, 'status_message'=> 'image file is too large. Max recommended size is  MB']; }

		$extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION); 

		return self::acceptedFormat($extension) ? ['status'=>true, 'status_message'=> 'image file validated for upload'] : ['status'=>false, 'status_message'=> 'Image format not allowed'];
		

    }



	/**
     * check if format of file is allowed
     * @param $format
     * @return bollean  
     */
    public static function acceptedFormat($format) {
		
		$formats = [
			"jpeg",
			"jpg",
			"png",
			"gif",
			"webp"
		];

		return in_array($format, $formats);

    }




    /**
     * upload file
     * @param $uploads
     * @return string|null $unique_name  
     */
    public static function upload($uploads) {

		$documentPath = \yii::getAlias('@webroot')."/uploads/";

		$restRequestData = Yii::$app->request->getBodyParams();
		// $uploads = \yii\web\UploadedFile::getInstanceByName('photo');
		$target_dir = \yii::getAlias('@webroot')."/uploads/";
		$target_file = $target_dir . basename($_FILES["photo"]["name"]);
  
		$postdata = fopen( $_FILES[ 'photo' ][ 'tmp_name' ], "r" );
		/* Get file extension */
		$extension = substr( $_FILES[ 'photo' ][ 'name' ], strrpos( $_FILES[ 'photo' ][ 'name' ], '.' ) );
  
		/* Generate unique name */
		$unique_name = uniqid() . $extension;
		$filename = $target_dir . $unique_name;
  
		  /* Open a file for writing */
		  $fp = fopen( $filename, "w" );
  
		  /* Read the data 1 KB at a time
			and write to the file */
		  while( $data = fread( $postdata, 1024 ) )
			  fwrite( $fp, $data );
  
		  /* Close the streams */
		  fclose( $fp );
		  fclose( $postdata );

		return $unique_name;
    }



	
}

?>