<?php


namespace app\controllers;




class SiteController extends Controller
{

    public static function contact(){
        return $this->render('contact',['name'=>'josiah']);
    }

    public static function submitContact(){
        return "Form Submitted";
    }
}