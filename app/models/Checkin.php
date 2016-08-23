<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Checkin extends Eloquent implements UserInterface, RemindableInterface {
	
	protected $fillable = [
		'requestby', 
		'requestdate', 
		'position', 
		'needdate', 
		'unit', 
		'documenttype', 
		'otherdocument', 
		'requesttype', 
		'documentcode', 
		'documentname',
		'issueno',
		'effectivedate',
		'cpiarno',
		'reason',
		'file',
		'status',
		'uhid',
		'uhdate',
		'uhnote',
		'qmrid',
		'qmrdate',
		'qmrnote',
		'dconid',
		'dcid',
		'dcondate',
		'dcdate',
		'dconnote',
		'dcnote',
		'ecid',
		'ecnote',
		'dappid',
		'dappnote',
		'dadmid',
		'dadmnote'
	];

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'checkin';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');

}
