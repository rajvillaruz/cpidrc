<?php

class SearchController extends \BaseController {

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
				$approval = Checkin::where('status', 1)->count();
				$approval2 = Checkin::where('status', 2)->count();
				$approval3 = Checkin::where('status', 3)->count();
				
				return Response::make(View::make('search')
					->with('user', $user)
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
		
		if(Auth::check())
		{
			if(Auth::user()->status == 1)
			{
				$user = Auth::user();
				$users = User::all();
				$input = Input::all();
				$search = $input['search'];
		
				$checkins = Checkin::where('id', 'LIKE', '%' . $search . '%')
							->orWhere('position', 'LIKE', '%' . $search . '%')
							->orWhere('documentcode', 'LIKE', '%' . $search . '%')
							->orWhere('documentname', 'LIKE', '%' . $search . '%')
							->orWhere('issueno', 'LIKE', '%' . $search . '%')
							->orWhere('cpiarno', 'LIKE', '%' . $search . '%')
							->orWhere('reason', 'LIKE', '%' . $search . '%')
							->orWhere('uhnote', 'LIKE', '%' . $search . '%')
							->orWhere('ecnote', 'LIKE', '%' . $search . '%')
							->orWhere('dappnote', 'LIKE', '%' . $search . '%')
							->get();
							
				$approval = Checkin::where('status', 1)->count();
				$approval2 = Checkin::where('status', 2)->count();
				$approval3 = Checkin::where('status', 3)->count();
		
				return Response::make(View::make('search')
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
				return View::make('index');
			}
		}

		Auth::logout();
		return View::make('index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
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
