<?php

class StatusController extends \BaseController {

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
				//$checkins = Checkin::where('requestby', '=', $user->id)->orderBy('id', 'desc')->get();
				$checkins = Checkin::orderBy('id', 'desc')->get();
				$approval = Checkin::where('status', 1)->count();
				$approval2 = Checkin::where('status', 2)->count();
				$approval3 = Checkin::where('status', 3)->count();
				
				return Response::make(View::make('status')
					->with('user', $user)
					->with('users', $users)
					->with('checkins', $checkins)
					->with('approval', $approval)
					->with('approval2', $approval2)
					->with('approval3', $approval3)
					, 200, $headers);
			}
			else 
			{
				Auth::logout();
				Session::flash('message', "Please contact Webmaster.");
				return View::make('index');
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
		$headers = array();
		$headers['Expires'] = 'Tue, 1 Jan 1980 00:00:00 GMT';
		$headers['Cache-Control'] = 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0';
		$headers['Pragma'] = 'no-cache';
		
		if (Auth::user()->status==1)
		{
			$input = Input::all();
		
			if(isset($input['fileButton']))
			{
				$file = "upload/" . $input['id'] . "/" . $input['file'];
				$headers = array('Content-Type' => 'application/pdf',);
				return Response::download($file, $input['file'], $headers);
			}
			else
			{					
				$user = Auth::user();
				$users = User::all();
				//$checkins = Checkin::where('requestby', '=', $user->id)->orderBy('id', 'desc')->get();
				$checkins = Checkin::orderBy('id', 'desc')->get();
				$approval = Checkin::where('status', 1)->count();
				$approval2 = Checkin::where('status', 2)->count();
				$approval3 = Checkin::where('status', 3)->count();
		
				$rules = array(
					'fromDate'=>'required',
					'toDate'=>'required',
					'documentType'=>'required',
					'requestType'=>'required'
				);
	
				$messages = array(
					'fromDate.required'=>'From date is required',
					'toDate.required'=>'To date is required',
					'documentType.required'=>'Document type is required',
					'requestType.required'=>'Request type is required'
				);	
	
				$validation = Validator::make(Input::All(), $rules, $messages);
	
				if($validation->fails())
				{
					return Redirect::back()->withInput()->withErrors($validation->messages());
				}
				else
				{
					$fromDate = date('Y-m-d', strtotime($input['fromDate']));
					$toDate = date('Y-m-d', strtotime($input['toDate']));
		
					$checkins = DB::table('checkin')
						->where('documenttype', '=', $input['documentType'])
						->whereBetween('requestdate', array($fromDate, $toDate))
						->orderBy('requestdate', 'desc')
						->get();
						
					if($input['documentType']==13 && $input['requestType']!=5)
					{
						$checkins = DB::table('checkin')
							->where('requesttype', '=', $input['requestType'])
							->whereBetween('requestdate', array($fromDate, $toDate))
							->orderBy('requestdate', 'desc')
							->get();
					}
					else if($input['requestType']==5 && $input['documentType']!=13)
					{
						$checkins = DB::table('checkin')
							->where('documenttype', '=', $input['documentType'])
							->whereBetween('requestdate', array($fromDate, $toDate))
							->orderBy('requestdate', 'desc')
							->get();
					}
					else if($input['requestType']==5 && $input['documentType']==13)
					{
						$checkins = DB::table('checkin')
							->whereBetween('requestdate', array($fromDate, $toDate))
							->orderBy('requestdate', 'desc')
							->get();
					}
					else
					{
						$checkins = DB::table('checkin')
							->where('documenttype', '=', $input['documentType'])
							->whereBetween('requestdate', array($fromDate, $toDate))
							->orderBy('requestdate', 'desc')
							->get();
					}
	
					return Response::make(View::make('status')
						->with('user', $user)
						->with('users', $users)
						->with('checkins', $checkins)
						->with('approval', $approval)
						->with('approval2', $approval2)
						->with('approval3', $approval3)
						, 200, $headers);
				}
			}
		}
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
		//
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
