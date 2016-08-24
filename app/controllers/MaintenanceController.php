<?php

class MaintenanceController extends \BaseController {

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
				$aUsers = User::All();
				$aUnit = Unit::All();
				$aDocType = DocType::All();

				return Response::make(View::make('maintenance')
					->with('user', $user)
					->with('approval', $approval)
					->with('approval2', $approval2)
					->with('approval3', $approval3)
					->with('aUsers', $aUsers)
					->with('aUnit', $aUnit)
					->with('aDocType', $aDocType)
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
		$input = Input::All();

		if($input['action'] == 'createUser')
		{
			$recent = 1;
			$rules = array(
				'username' => 'required',
				'password' => 'required',
				'firstName' => 'required',
				'lastName' => 'required',
				'email' => 'required'
			);

			$messages = array(
				'username.required' => 'User Name is required.',
				'password.required' => 'Password is required.',
				'firstName.required' => 'First Name is required.',
				'lastName.required' => 'Last Name is required.',
				'email.required' => 'Email is required.'
			);

			$validation = Validator::make(Input::all(), $rules, $messages);

			if($validation->fails())
			{
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			else
			{
				$test = DB::table('users')->where('username', $input['username']);

				if($test->count())
				{
					Session::flash('message', "Username already exist.");
					return Redirect::back()->withInput();
				}
				else
				{

					$aPrivilege = array('admin', 'unitHead', 'qmr', 'dc');

					foreach($aPrivilege as $privileges)
					{
						if(isset($input['privileges']))
						{
							foreach($input['privileges'] as $privilege)
							{
								if($privilege == $privileges)
								{
									$aPriv[$privileges] = 1;
								}
							}

							if(!isset($aPriv[$privileges]))
							{
								$aPriv[$privileges] = 0;
							}
						}
						else
						{
							$aPriv[$privileges] = 0;
						}
					}

					User::create([
						'username' => $input['username'],
						'password' => Hash::make($input['password']),
						'firstname' => $input['firstName'],
						'lastname' => $input['lastName'],
						'email' => $input['email'],
						'status' => 1,
						'user' => $aPriv['admin'],
						'unithead' => $aPriv['unitHead'],
						'qmr' => $aPriv['qmr'],
						'dcon' => $aPriv['dc'],
					]);

					Session::flash('message', "Successfully created user.");
					return Redirect::back();
				}
			}
		}
		elseif ($input['action'] == 'addUnit')
		{
			$rules = array(
				'unitName' => 'required',
				'unitDesc' => 'required'
			);

			$messages = array(
				'unitName.required' => 'Name is required.',
				'unitDesc.required' => 'Description is required.'
			);

			$validation = Validator::make(Input::all(), $rules, $messages);

			if($validation->fails())
			{
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			else
			{
				$test = DB::table('unit')->where('name', $input['unitName']);

				if($test->count())
				{
					Session::flash('message', "Name already exist.");
					return Redirect::back()->withInput();
				}
				else
				{
					Unit::create([
						'name' => $input['unitName'],
						'description' => $input['unitDesc'],
						'status' => 1
					]);

					Session::flash('message', "Successfully added a unit.");
					return Redirect::back();
				}
			}
		}
		elseif ($input['action'] == 'addDocType')
		{
			$rules = array(
				'docTypeName' => 'required',
				'docTypeDesc' => 'required'
			);

			$messages = array(
				'docTypeName.required' => 'Name is required.',
				'docTypeDesc.required' => 'Description is required.'
			);

			$validation = Validator::make(Input::all(), $rules, $messages);

			if($validation->fails())
			{
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			else
			{
				$test = DB::table('doctype')->where('name', $input['docTypeName']);

				if($test->count())
				{
					Session::flash('message', "Name already exist.");
					return Redirect::back()->withInput();
				}
				else
				{
					DocType::create([
						'name' => $input['docTypeName'],
						'description' => $input['docTypeDesc'],
						'status' => 1
					]);

					Session::flash('message', "Successfully added a Type of Document.");
					return Redirect::back();
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
		$input = Input::All();

		if($input['action'] == 'editUser')
		{
			$action = 1;
			$rules = array(
				'updateFirstName' => 'required',
				'updateLastName' => 'required',
				'updateEmail' => 'required'
			);

			$messages = array(
				'updateFirstName.required' => 'First Name is required.',
				'updateLastName.required' => 'Last Name is required.',
				'updateEmail.required' => 'Email is required.'
			);

			$validation = Validator::make(Input::all(), $rules, $messages);

			if($validation->fails())
			{
				//	return Redirect::back()->withInput()->withErrors($validation->messages());
				//	Rochelle Villaruz : replaced withInput()-> with with('edit', $action)->
				return Redirect::back()->with('edit', $action)->withErrors($validation->messages());

			}
			else
			{
				$aPrivilege = array('status', 'admin', 'unitHead', 'qmr', 'dc');

				foreach($aPrivilege as $privileges)
				{
					if(isset($input['uPrivileges']))
					{
						foreach($input['uPrivileges'] as $privilege)
						{
							if($privilege == $privileges)
							{
								$uPriv[$privileges] = 1;
							}
						}

						if(!isset($uPriv[$privileges]))
						{
							$uPriv[$privileges] = 0;
						}
					}
					else
					{
						$uPriv[$privileges] = 0;
					}
				}

				$updateUser = User::Find($id);

				$updateUser->firstname = $input['updateFirstName'];
				$updateUser->lastname = $input['updateLastName'];
				$updateUser->email = $input['updateEmail'];
				$updateUser->status = $uPriv['status'];
				$updateUser->user = $uPriv['admin'];
				$updateUser->unithead = $uPriv['unitHead'];
				$updateUser->qmr = $uPriv['qmr'];
				$updateUser->dcon = $uPriv['dc'];
				$updateUser->save();

				Session::flash('message', "Successfully updated user.");
				return Redirect::back();
			}
		}
		elseif($input['action'] == 'editUnit')
		{
			if(isset($input['unitStatus']))
			{
				$status = 1;
			}
			else
			{
				$status = 0;
			}

			$updateUnit = unit::Find($id);
			$updateUnit->status = $status;
			$updateUnit->save();

			Session::flash('message', "Successfully updated unit.");
			return Redirect::back();
		}
		elseif($input['action'] == 'editDocType')
		{
			if(isset($input['docTypeStatus']))
			{
				$status = 1;
			}
			else
			{
				$status = 0;
			}

			$updateDocType = DocType::Find($id);
			$updateDocType->status = $status;
			$updateDocType->save();

			Session::flash('message', "Successfully updated unit.");
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
