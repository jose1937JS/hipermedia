<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Password_Reset extends CI_Model {

	public function get_all($token)
	{
		return $this->db->get_where("password_resets", ["token" => $token])->result();
	}

	public function fill($data)
	{
		$this->db->insert('password_resets', $data);
	}
}