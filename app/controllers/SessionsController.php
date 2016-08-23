<?php

class SessionsController extends \BaseController {

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
				
				return Response::make(View::make('user')
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
				return Redirect::back();
			}
		}
		
		Auth::logout();
		return View::make('index');
	}
	
	public function store()
	{
		$headers = array();
		$headers['Expires'] = 'Tue, 1 Jan 1980 00:00:00 GMT';
		$headers['Cache-Control'] = 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0';
		$headers['Pragma'] = 'no-cache';
		$headers['location'] = 'index.php';
		
		$rules = array(
			'username' => 'required|alpha_num',
			'password' => 'required|alpha_num'
		);
		
		$messages = array(
			'username.required' => 'Please enter your Username.',
			'password.required' => 'Please enter your Password.',
			'username.alpha_num' => 'Make sure your Username is correct.',
			'password.alpha_num' => "Make sure your Password is correct."
		);
		
		$validation = Validator::make(Input::all(), $rules, $messages);
		
		if($validation->fails())
		{
			Session::flush();
			return Redirect::back()->withInput()->withErrors($validation->messages());	
		}
		else 
		{
			if(Auth::attempt(Input::only('username', 'password')))
			{
				if(Auth::user()->status == 1)
				{
					$user = Auth::user();
					$approval = Checkin::where('status', 1)->count();
					$approval2 = Checkin::where('status', 2)->count();
					$approval3 = Checkin::where('status', 3)->count();
				
					return Response::make(View::make('user')
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
					return Redirect::back();
				}
			}
			else
			{
				Session::flash('message', "Please check your Username and Password.");
				return Redirect::back()->withInput();
			}
		}
	}

	public function destroy()
	{
		Auth::logout();
		Session::flush();
		return Redirect::route('sessions.index');
	}
}
