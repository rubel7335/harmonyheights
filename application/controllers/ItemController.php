<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class ItemController extends CI_Controller {


   /**

    * Get All Data from this method.

    *

    * @return Response

   */

   public function __construct() {

      parent::__construct();
      $this->load->database();

   }


   /**

    * Get All Data from this method.

    *

    * @return Response

   */

   public function ajaxRequest()

   {

       $data['data'] = $this->db->get("items")->result();

       $this->load->view('itemlist', $data);

   }


   /**

    * Get All Data from this method.

    *

    * @return Response

   */

   public function ajaxRequestPost()

   {

      $data = array(

            'title' => $this->input->post('title'),

            'description' => $this->input->post('description')

        );

      $this->db->insert('items', $data);


      echo 'Added successfully.';  

   }

}