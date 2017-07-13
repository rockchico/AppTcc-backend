<?php
/**
 * Created by PhpStorm.
 * User: francisco
 * Date: 10/07/17
 * Time: 23:29
 */
namespace App\Controller;

class ImagesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index() {

        $post = null;
        $jsonResponse = (object) array();

        if ($this->request->is('post')) {

            $post = $this->request->data();

            $this->log("post", "debug");
            $this->log($post, "debug");


            if($post) {

                $jsonResponse->success = "yes";

                $images = $this->Images->find('all');


                $images = $this->Images->find()->where(['place_id' => $post['place_id']]);
                $result = $images->toArray();

                $jsonResponse->images = $result;

            }

        }
        $this->set('jsonResponse', $jsonResponse);
    }


    public function create() {

        $post = null;
        $jsonResponse = (object) array();

        $image = $this->Images->newEntity();

        if ($this->request->is('post')) {

            $post = $this->request->data();

            $this->log("Post", "debug");
            $this->log($post, "debug");

            //$this->log("FIles", "debug");
            //$this->log($_FILES, "debug");


            if($post) {
                $image->place_id = $post['place_id'];

                if ($result = $this->Images->save($image)) {
                    $jsonResponse->success = "yes";
                    $jsonResponse->lastInsertId = $result->id;
                    $jsonResponse->place_id = $post['place_id'];
                } else {
                    $jsonResponse->success = "no";
                }

            }

        }
        $this->set('jsonResponse', $jsonResponse);
    }


    public function delete() {

        $post = null;
        $jsonResponse = (object) array();

        $this->request->allowMethod(['post', 'delete']);

        if ($this->request->is('post')) {

            $post = $this->request->data();

            $image = $this->Images->get($post['id']);
            if ($this->Images->delete($image)) {
                $jsonResponse->success = "yes";
            } else {
                $jsonResponse->success = "no";
            }
        }

        $this->set('jsonResponse', $jsonResponse);


    }




}
?>