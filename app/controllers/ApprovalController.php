<?php

class ApprovalController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$headers = array();
		$headers['Expires'] = 'Tue, 1 Jan 1980 00:00:00 GMT';
		$headers['Cache-Control'] = 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0';
		$headers['Pragma'] = 'no-cache';
		
		if(Auth::check())
		{
			if(Auth::user()->status == 1)
			{
				$user = Auth::user();
				$users = User::all();
				$get = $_GET['link'];
				
				if($get == 1)
				{
					$checkins = Checkin::where('status', 1)->get();
				}
				elseif($get == 2)
				{
					$checkins = Checkin::where('status', 2)->get();
				}
				elseif($get == 3)
				{
					$checkins = Checkin::where('status', 3)->get();
				}
				else
				{
					Auth::logout();
					Session::flash('message', "Please contact Webmaster.");
					return Redirect::back();
				}
				
				$approval = Checkin::where('status', 1)->count();
				$approval2 = Checkin::where('status', 2)->count();
				$approval3 = Checkin::where('status', 3)->count();
				
				return Response::make(View::make('approval')
					->with('user', $user)
					->with('checkins', $checkins)
					->with('users', $users)
					->with('approval', $approval)
					->with('approval2', $approval2)
					->with('approval3', $approval3)
					, 200, $headers);
			}
			else 
			{
				Auth::logout();
				Session::flash('message', "Please contact Webmaster.");
				return Redirect::back();
			}
		}
		
		Auth::logout();
		return View::make('index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
		$file = "upload/" . $input['id'] . "/" . $input['file'];
		
		$headers = array('Content-Type' => 'application/pdf',);
		
		return Response::download($file, $input['file'], $headers);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$user = Auth::user();
		
		if($input['status' . $id] != 1)
		{
			$rules = array(
				'note' . $id => 'required',
				'status' . $id => 'required'
			);
		}
		else
		{	
			$rules = array(
				'status' . $id => 'required'
			);
		}
		
		$messages = array(
			'note' . $id . '.required' => 'Note is required.',
			'status' . $id . '.required' => 'Status is required.'
		);
		
		$validation = Validator::make(Input::all(), $rules, $messages);
		
		if($validation->fails())
		{
			Session::flash('checker', $id);
			return Redirect::back()->withInput()->withErrors($validation->messages());
		}
		else 
		{
			$input = Input::all();
			$checkin = Checkin::Find($id);
			$status = $checkin['status'] +  $input['status' . $id];
			
			date_default_timezone_set("Asia/Manila"); 
			$today = date("Y-m-d H:i:s");
			
			if($checkin['status'] == 1)
			{
				$checkin->status = $status;
				$checkin->uhid = $user['id'];
				$checkin->uhnote = $input['note' . $id];
				$checkin->uhdate = $today;
				$checkin->save();
			}
			elseif($checkin['status'] == 2)
			{
				$checkin->status = $status;
				$checkin->qmrid = $user['id'];
				$checkin->qmrnote = $input['note' . $id];
				$checkin->qmrdate = $today;
				$checkin->save();
			}
			elseif($checkin['status'] == 3)
			{
				$checkin->status = $status;
				$checkin->dconid = $user['id'];
				$checkin->dconnote = $input['note' . $id];
				$checkin->dcondate = $today;
				$checkin->save();
			}
			else 
			{
				return Redirect::back();
			}

			return Redirect::back();
		} 
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
