<?php
//namespace Cloudinary;
require_once __DIR__ . '/vendor/autoload.php';

//require Cloudinary\Cloudinary::class;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Argument\Color;
use Cloudinary\Transformation\Background;
use Cloudinary\Transformation\Resize;

//configuring Cloudinary SDK
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'agusioma',
        'api_key' => '957489173493642',
        'api_secret' => 'ajh4dnXB0jjEk7-tnHd_pqNLZDY'],
    'url' => [
        'secure' => true]]);

//image upload
function uploadOurImage()
{
    //$response = (new UploadApi())->upload("nature.jpg", ["public_id" => "nature_in_cloud"]);
    $response = (new UploadApi())->upload("nature.jpg", [
        "use_filename" => TRUE,
        "unique_filename" => FALSE]);
    //print_r($response)
}

//uploadOurImage();

function getAssetDetails()
{
    $res = (new AdminApi())->asset("nature");
    print_r($res);
}

//getAssetDetails();

function resizeOurImageHTML()
{
   /* $cld = new Cloudinary();
    $res = $cld->imageTag('nature_in_cloud')->resize(Resize::pad()
            ->height(1280)
            ->width(852)
            ->background(Background::color(Color::BLACK)));*/
    $res = (new ImageTag("nature"))
            ->resize(Resize::pad()
            ->height(1280)
            ->width(852)
            ->background(Background::color(Color::RED))
        );

    print($res);
}

//resizeOurImageHTML();

function resizeOurImageURLOnly(){
    $cld = new Cloudinary([
        'cloud' => [
            'cloud_name' => 'agusioma',
            'api_key'  => '957489173493642',
            'api_secret' => 'ajh4dnXB0jjEk7-tnHd_pqNLZDY',
            'url' => [
                'secure' => true]]]);
    $res = $cld->image('nature')
        ->resize(Resize::pad()
        ->height(1280)
        ->width(852)
        ->background(Background::color(Color::RED)))
        ->toUrl();
    print($res);

}

resizeOurImageURLOnly()

/*
 *
 * Links needed
 1. IMAGE UPLOAD: https://cloudinary.com/documentation/upload_images
 2. get_the_details_of_a_single_resource: https://cloudinary.com/documentation/admin_api#get_the_details_of_a_single_resource
 3. transformation_reference: https://cloudinary.com/documentation/transformation_reference
*/
?>