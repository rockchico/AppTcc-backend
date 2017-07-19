<?php
/**
 * Created by PhpStorm.
 * User: francisco
 * Date: 10/07/17
 * Time: 23:29
 */
namespace App\Controller;

class PlacesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index() {

        $jsonPost = null;
        $jsonResponse = (object) array();

        if ($this->request->is('post')) {

            $jsonPost = $this->request->data();

            $this->log("jsonPost", "debug");
            $this->log($jsonPost, "debug");


            if($jsonPost) {

                $jsonResponse->success = "yes";

                $places = $this->Places->find('all');

                $jsonResponse->places = $places;

            }

        }
        $this->set('jsonResponse', $jsonResponse);
    }

    public function getjsonlist() {


        $this->autoRender = false;
        $this->response->type('json');


        $jsonPost = null;
        $jsonResponse = (object) array();
        $places = (object) array();

        if ($this->request->is('post')) {

            $jsonPost = $this->request->data();

            $this->log("jsonPost", "debug");
            $this->log($jsonPost, "debug");


            if($jsonPost) {

                //$jsonResponse->success = "yes";

                //$places = $this->Places->find('all')->where(['name' => "%".$jsonPost['query']."%"]);

                $places = $this->Places->find('all');



                //$jsonResponse->places = $places;

            }

        }
        //$this->set('jsonResponse', $jsonResponse);


        $jsonResponse = json_encode($places);
        $this->response->body($jsonResponse);

    }



    public function create() {

        $jsonPost = null;
        $jsonResponse = (object) array();

        $place = $this->Places->newEntity();

        if ($this->request->is('post')) {

            $this->log("request->data()", "debug");
            $this->log($this->request->data(), "debug");

            //$jsonPost = $this->request->input('json_decode');

            $jsonPost = $this->request->data();

            $this->log("jsonPost", "debug");
            $this->log($jsonPost, "debug");


            if($jsonPost) {
                $place->name = $jsonPost['name'];
                $place->x = $jsonPost["x"];
                $place->y = $jsonPost["y"];

                if ($result = $this->Places->save($place)) {
                    $jsonResponse->success = "yes";
                    $jsonResponse->lastInsertId = $result->id;
                } else {
                    $jsonResponse->success = "no";
                }

            }

        }
        $this->set('jsonResponse', $jsonResponse);
    }



}
?>