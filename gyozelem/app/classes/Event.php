<?php 
class Event extends Model {
	public static $TABLE_NAME = "events";
	public $id;  
	public $user_id;  
	public $posted_at;  
	public $event_at;  
	public $title; 
	public $guests; 
	public $message;
	public $visibility;
}