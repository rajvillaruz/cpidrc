<?php

class ReportController extends \BaseController {

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
				
				return Response::make(View::make('report')
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
		$headers = array();
		$headers['Expires'] = 'Tue, 1 Jan 1980 00:00:00 GMT';
		$headers['Cache-Control'] = 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0';
		$headers['Pragma'] = 'no-cache';
		
		if(Auth::user()->status == 1)
		{
			$input = Input::All();
			Input::flash();
			
			$rules = array(
				'fromDate' => 'required',
				'toDate' => 'required',
				'documentType' => 'required'
			);
			
			$messages = array(
				'fromDate.required' => 'From Date is required.',
				'toDate.required' => 'To Date is required.',
				'documentType.required' => 'Document Type is required.'
			);
			
			$validation = Validator::make(Input::all(), $rules, $messages);
			
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
					->whereBetween('effectivedate', array($fromDate, $toDate))
					->orderBy('effectivedate', 'desc')
					->get();
				
				if($input['documentType']==13){
					$checkins = DB::table('checkin')
					->whereBetween('effectivedate', array($fromDate, $toDate))
					->orderBy('effectivedate', 'desc')
					->get();
				}
				else {
					$checkins = DB::table('checkin')
					->where('documenttype', '=', $input['documentType'])
					->whereBetween('effectivedate', array($fromDate, $toDate))
					->orderBy('effectivedate', 'desc')
					->get();
				}
				
				$user = Auth::user();
				$users = User::all();
				$approval = Checkin::where('status', 1)->count();
				$approval2 = Checkin::where('status', 2)->count();
				$approval3 = Checkin::where('status', 3)->count();
			
				if(!empty($input['extract']))
				{
					$headers = array(
						'Pragma' => 'public',
						'Expires' => 'public',
						'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
						'Cache-Control' => 'private',
						'Content-Type' => 'application/vnd.ms-excel',
						'Content-Disposition' => 'attachment; filename=report.xls',
						'Content-Transfer-Encoding' => ' binary'
					);
				
					 $output1 = 
						'<table>
								<thead>
    								<tr>
        								<th>Request Date</th>
        								<th>Position</th>
										<th>Date Needed</th>                                                       
									</tr>
								</thead>
							<tfoot>
								<tr>
									<td colspan="3"></td>
								</tr>
							</tfoot>
							<tbody>';

					$output2 = "";
					foreach($checkins as $checkin)
					{
						$requestdate = $checkin->requestdate;
						$position = $checkin->position;
						$needdate = $checkin->needdate;
						$output2 .=
							'<tr>
    							<td>' . $requestdate . '</td>
        						<td>' . $position . '</td>
        						<td>' . $needdate . '</td>
    						</tr>';
					}
	
					$output3 = 
							'</tbody>
						</table>';

					$output = $output1 . $output2 . $output3;

					return Response::make($output, 200, $headers);		
				}
			
				return Response::make(View::make('report')
					->with('user', $user)
					->with('users', $users)
					->with('approval', $approval)
					->with('approval2', $approval2)
					->with('approval3', $approval3)
					->with('checkins', $checkins)
					->with('input', $input)
					, 200, $headers);
			}
		}
		else 
		{
			Auth::logout();
			Session::flash('message', "Please contact Webmaster.");
			return View::make('index');
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
