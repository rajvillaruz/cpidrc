<?php

class CheckinController extends \BaseController {

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
				
				return Response::make(View::make('checkin')
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
		
		$rules = array(
			'unit' => 'required',
			'documentType' => 'required',
			'requestType' => 'required',
			'documentCode' => 'required',
			'documentName' => 'required',
			'issueNo' => 'required',
			'effectiveDate' => 'required',
			'cpiarNo' => 'max:100',
			'reason' => 'required'
		);
		
		if($input['requestType'] != 3)
		{
			$rules = array_merge($rules, array('file' => 'required'));
		}
			
		$messages = array(
			'unit.required' => 'Unit is required.',
			'documentType.required' => 'Type of Document is required.',
			'requestType.required' => 'Type of Request is required.',
			'documentCode.required' => 'Document Code is required.',
			'documentName.required' => 'Document Name is required.',
			'issueNo.required' => 'Issue/Revision No is required.',
			'effectiveDate.required' => 'Effective Date is required.',
			'cpiarNo.max' => 'Maximum characters for CPIAR No is 100.',
			'reason.required' => 'Reason for Request is required.'
		);
		
		if($input['requestType'] != 3)
		{
			$messages = array_merge($messages, array('file.required' => 'File is required.'));
		}
		
		$validation = Validator::make(Input::all(), $rules, $messages);
		
		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		}
		else 
		{
			if($input['requestType'] != 3)
			{
				$file =  Input::file('file')->getClientOriginalName();
				
				$checkFile = DB::table('checkin')
										->where('file', $file)
										->whereIn('status', array(1,2,3))
										->get();
				
				if($checkFile)
				{
					Session::flash('error', "There is a pending checkin for this file.");
					return Redirect::back()->withInput();
				}
				
				//if (File::exists('upload/' . $file))
				//{
				//	Session::flash('error', "File already Exist.");
				//	return Redirect::back()->withInput();
				//}
				//else 
				//{
					date_default_timezone_set("Asia/Manila"); 
					$today = date("Y-m-d H:i:s");
					$status = 1;
				
					Checkin::create([
						'requestby' => Auth::user()->id,
						'requestdate' => $today,
						'unit' => $input['unit'],
						'documenttype' => $input['documentType'],
						'requesttype' => $input['requestType'],
						'documentcode' => $input['documentCode'],
						'documentname' => $input['documentName'],
						'issueno' => $input['issueNo'],
						'effectivedate' => date('Y-m-d', strtotime($input['effectiveDate'])),
						'cpiarno' => $input['cpiarNo'],
						'reason' => $input['reason'],
						'file' => $file,
						'status' => $status
					]);
					
					$checkinId = DB::getPdo()->lastInsertId();
					
					mkdir('upload/' . $checkinId, 0777, true);
					
					Input::file('file')->move('upload/'. $checkinId, $file);
					
					Session::flash('message', "Submitted for approval.");
					return Redirect::back();
				//}			
			}
			else 
			{
				date_default_timezone_set("Asia/Manila"); 
				$today = date("Y-m-d H:i:s");
				$status = 1;
				
				Checkin::create([
					'requestby' => Auth::user()->id,
					'requestdate' => $today,
					'unit' => $input['unit'],
					'documenttype' => $input['documentType'],
					'requesttype' => $input['requestType'],
					'documentcode' => $input['documentCode'],
					'documentname' => $input['documentName'],
					'issueno' => $input['issueNo'],
					'effectivedate' => date('Y-m-d', strtotime($input['effectiveDate'])),
					'cpiarno' => $input['cpiarNo'],
					'reason' => $input['reason'],
					'status' => $status
				]);
					
				Session::flash('message', "Submitted for approval.");
				return Redirect::back();
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
