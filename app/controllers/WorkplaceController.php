<?php

class WorkplaceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$skip = Input::get('skip');
		$groups = Workplace::all();
		if( $skip ) {
/* 			$r->skip($skip); */
		}
		return Response::json($groups);
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
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$workplace = Workplace::find($id);
		
		$participants = Registrant::where('workplace_id', $id)->get();
		
		$count = $participants->count();
		
		if( $workplace->workplace_headcount != 0 ) {
			$percent_participation = $count / $workplace->workplace_headcount;
			$workplace->pp = $percent_participation;
		}
		
		foreach( $participants as $particpant )
		{
			// $km += $participant;
		}
		
		$response = 
		[
			[
				'x' => 1234,
				'y' => $percent_participation,
				'r' => 30,
				'label' => 'hello'
			],
			[
				'x' => 4321,
				'y' => $percent_participation,
				'r' => 20,
				'label' => 'second'
			],
		];
		
		return Response::json( $response );
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
